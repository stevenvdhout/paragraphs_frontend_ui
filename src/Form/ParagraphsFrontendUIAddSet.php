<?php
namespace Drupal\paragraphs_frontend_ui\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs_frontend_ui\ParagraphSetListBuilder;
use Drupal\paragraphs_frontend_ui\Entity\ParagraphSet;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\CloseDialogCommand;

/**
 * Class CleanupUrlAliases.
 *
 * @package Drupal\paragraphs_ui_add_set\Form
 */
class ParagraphsFrontendUIAddSet extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'paragraphs_frontend_ui_add_set';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $paragraph = NULL) {
    
    // set the paragraph to the form state
    $form_state->addBuildInfo('paragraph', $paragraph);

    // render the sets
    $sets = \Drupal::entityTypeManager()->getListBuilder('paragraph_set')->load();
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('paragraph_set');
    foreach ($sets as $set) {
      $form['sets'][$set->id()] = [
        '#type' => 'container',
      ];
      $form['sets'][$set->id()]['element'] = $view_builder->view($set);
      $form['sets'][$set->id()]['add_set'] = [
        '#type' => 'button',
        '#name' => $set->id() . '_add_set',
        '#value' => $this->t('Add'),
        '#ajax' => array(
          'callback' => array(get_class($this), 'addMoreAjax'),
          'effect' => 'fade',
        ),
      ];
    }

    return $form;

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // @todo create an ajax fallback
  }

  /**
   * {@inheritdoc}
   */
  public static function addMoreAjax(array $form, FormStateInterface $form_state) {
    $build_info = $form_state->getBuildInfo();

    $triggering_paragraph = $build_info['paragraph'];

    $response = new AjaxResponse();

    $trigger = $form_state->getTriggeringElement()['#name'];
    $set = substr($trigger, 0, -8);
    if (is_numeric($set)) {

      $set = ParagraphSet::load($set);
      $set_paragraph = Paragraph::load($set->get('field_paragraph')->getValue()[0]['target_id']);
      
      $parent = $triggering_paragraph->getParentEntity();
      $parent_type = $parent->getEntityTypeId();
      $parent_bundle = $parent->getType();
      $parent_entity_id = $parent->id();
      $parent_field_name = $triggering_paragraph->get('parent_field_name')->getValue()[0]['value'];

      $paragraph_items = $parent->$parent_field_name->getValue();
      $paragraphs_new = [];
      foreach ($paragraph_items as $delta => $paragraph_item) {
        $paragraphs_new[] = $paragraph_item;
        if ($paragraph_item['target_id'] == $triggering_paragraph->id()) {
          
          $new_paragraph = $set_paragraph->createDuplicate();
          $new_paragraph->save();
          $paragraphs_new[] = array(
            'target_id' => $new_paragraph->id(),
            'target_revision_id' => $new_paragraph->getRevisionId(),
          );
        }

      }
      $parent->$parent_field_name->setValue($paragraphs_new);
      $parent->save();

      $identifier = '[data-paragraphs-frontend-ui=' . $parent_field_name . '-' . $parent->id() . ']';
      $response = new AjaxResponse();
      // Refresh the paragraphs field.
      $response->addCommand(
        new ReplaceCommand(
          $identifier,
          $parent->get($parent_field_name)->view('default')
        )
      );
      return $response;


    }


//    return $element;
    /*$command = new CloseModalDialogCommand();
    $response->addCommand($command);
    return $response;*/
  }
 



}
