<?php

namespace Drupal\paragraphs_frontend_ui\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Paragraph set entities.
 *
 * @ingroup paragraphs_frontend_ui
 */
interface ParagraphSetInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Paragraph set name.
   *
   * @return string
   *   Name of the Paragraph set.
   */
  public function getName();

  /**
   * Sets the Paragraph set name.
   *
   * @param string $name
   *   The Paragraph set name.
   *
   * @return \Drupal\paragraphs_frontend_ui\Entity\ParagraphSetInterface
   *   The called Paragraph set entity.
   */
  public function setName($name);

  /**
   * Gets the Paragraph set creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Paragraph set.
   */
  public function getCreatedTime();

  /**
   * Sets the Paragraph set creation timestamp.
   *
   * @param int $timestamp
   *   The Paragraph set creation timestamp.
   *
   * @return \Drupal\paragraphs_frontend_ui\Entity\ParagraphSetInterface
   *   The called Paragraph set entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Paragraph set published status indicator.
   *
   * Unpublished Paragraph set are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Paragraph set is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Paragraph set.
   *
   * @param bool $published
   *   TRUE to set this Paragraph set to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\paragraphs_frontend_ui\Entity\ParagraphSetInterface
   *   The called Paragraph set entity.
   */
  public function setPublished($published);

}
