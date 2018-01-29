<?php

namespace Drupal\paragraphs_frontend_ui\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Paragraph set entities.
 */
class ParagraphSetViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
