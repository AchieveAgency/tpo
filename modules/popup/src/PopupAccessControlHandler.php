<?php

namespace Drupal\tpo_popup;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Popup entity.
 *
 * @see \Drupal\tpo_popup\Entity\Popup.
 */
class PopupAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\tpo_popup\Entity\PopupInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished popup entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published popup entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit popup entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete popup entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add popup entities');
  }

}
