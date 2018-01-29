<?php

namespace Drupal\paragraphs_frontend_ui\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Paragraph set edit forms.
 *
 * @ingroup paragraphs_frontend_ui
 */
class ParagraphSetForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\paragraphs_frontend_ui\Entity\ParagraphSet */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Paragraph set.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Paragraph set.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.paragraph_set.canonical', ['paragraph_set' => $entity->id()]);
  }

}
