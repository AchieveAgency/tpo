<?php

namespace Drupal\tpo_popup\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Popup entities.
 *
 * @ingroup tpo_popup
 */
interface PopupInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Popup name.
   *
   * @return string
   *   Name of the Popup.
   */
  public function getName();

  /**
   * Sets the Popup name.
   *
   * @param string $name
   *   The Popup name.
   *
   * @return \Drupal\tpo_popup\Entity\PopupInterface
   *   The called Popup entity.
   */
  public function setName($name);

  /**
   * Gets the Popup creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Popup.
   */
  public function getCreatedTime();

  /**
   * Sets the Popup creation timestamp.
   *
   * @param int $timestamp
   *   The Popup creation timestamp.
   *
   * @return \Drupal\tpo_popup\Entity\PopupInterface
   *   The called Popup entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Popup published status indicator.
   *
   * Unpublished Popup are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Popup is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Popup.
   *
   * @param bool $published
   *   TRUE to set this Popup to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\tpo_popup\Entity\PopupInterface
   *   The called Popup entity.
   */
  public function setPublished($published);

}
