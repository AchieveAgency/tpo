<?php

namespace Drupal\tpo_campaign;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Campaign entities.
 *
 * @ingroup tpo_campaign
 */
class CampaignListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Campaign ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\tpo_campaign\Entity\Campaign */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.tpo_campaign.edit_form',
      ['tpo_campaign' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
