<?php
namespace Drupal\paragraphs_frontend_ui\Form;

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\field\Entity\FieldConfig;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\paragraphs_browser\Ajax\AddParagraphTypeCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\paragraphs_browser\Form\ParagraphsBrowserForm;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Ajax\ReplaceCommand;

/**
 * Class CleanupUrlAliases.
 *
 * @package Drupal\paragraphs_browser\Form
 */
class ParagraphsFrontendUIBrowserForm extends ParagraphsBrowserForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'paragraphs_frontend_ui_browser_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, FieldConfig $field_config = null, $paragraphs_browser_type = null, $uuid = null, $paragraph = null) {
    $form = parent::buildForm($form, $form_state, $field_config, $paragraphs_browser_type, $uuid);
    $form_state->addBuildInfo('paragraph', $paragraph);
    return $form;

  }


  /**
   * {@inheritdoc}
   */
  public static function addMoreAjax(array $form, FormStateInterface $form_state) {
    $build_info = $form_state->getBuildInfo();
    $response = new AjaxResponse();

    $type = $form_state->getTriggeringElement()['#bundle_machine_name'];

    if ($paragraph = $build_info['paragraph']) {
      $triggering_paragraph = $paragraph;
      

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
          if ($default_paragraph_id = \Drupal::state()->get('paragraphs_frontend_ui_' . $type . '_default')) {
            $default_paragraph = Paragraph::load($default_paragraph_id);
            $new_paragraph = $default_paragraph->createDuplicate();
            $new_paragraph->save();
            $paragraphs_new[] = array(
              'target_id' => $new_paragraph->id(),
              'target_revision_id' => $new_paragraph->getRevisionId(),
            );
          }

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
    $command = new CloseModalDialogCommand();
    $response->addCommand($command);
    return $response;
  }
 



}
