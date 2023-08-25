<?php

namespace Drupal\custom_movie_event\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\Core\Entity\EntityInterface;

/**
 * Event that is fired when the node is viewed.
 */
class NodeViewEvent extends Event {

  /**
   * Event name.
   */
  const EVENT_NAME = 'custom_movie_event_node_view';

  /**
   * @var \Drupal\Core\Entity\EntityInterface $entity
   */
  public $entity;

  /**
   * Constructor to instantiate entity object.
   * 
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   To access fields of node.
   */
  public function __construct(EntityInterface $entity) {
    $this->entity = $entity;
  }
  
}
