<?php

namespace Drupal\tpo_popup;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Popup entities.
 *
 * @ingroup tpo_popup
 */
class PopupListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Popup ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\tpo_popup\Entity\Popup */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.tpo_popup.edit_form',
      ['tpo_popup' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
