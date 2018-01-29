<?php

namespace Drupal\paragraphs_frontend_ui;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Paragraph set entity.
 *
 * @see \Drupal\paragraphs_frontend_ui\Entity\ParagraphSet.
 */
class ParagraphSetAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\paragraphs_frontend_ui\Entity\ParagraphSetInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished paragraph set entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published paragraph set entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit paragraph set entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete paragraph set entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add paragraph set entities');
  }

}
