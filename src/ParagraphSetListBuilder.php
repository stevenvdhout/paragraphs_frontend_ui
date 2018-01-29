<?php

namespace Drupal\paragraphs_frontend_ui;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Paragraph set entities.
 *
 * @ingroup paragraphs_frontend_ui
 */
class ParagraphSetListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Paragraph set ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\paragraphs_frontend_ui\Entity\ParagraphSet */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.paragraph_set.edit_form',
      ['paragraph_set' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
