<?php

namespace Drupal\movie_module;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of award winning movies.
 */
class AwardWinningMovieListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Movie Name');
    $header['id'] = $this->t('Machine name');
    $header['movie_year'] = $this->t('Movie Year');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\movie_module\AwardWinningMovieInterface $entity */
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['movie_year'] = $entity->get('movie_year');
    return $row + parent::buildRow($entity);
  }

}
