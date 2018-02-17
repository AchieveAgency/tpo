<?php

namespace Drupal\tpo_popup\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Popup entities.
 */
class PopupViewsData extends EntityViewsData {

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
