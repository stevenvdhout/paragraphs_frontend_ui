<?php

/**
 * @file
 * Contains paragraph_set.page.inc.
 *
 * Page callback for Paragraph set entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Paragraph set templates.
 *
 * Default template: paragraph_set.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_paragraph_set(array &$variables) {
  // Fetch ParagraphSet Entity Object.
  $paragraph_set = $variables['elements']['#paragraph_set'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
