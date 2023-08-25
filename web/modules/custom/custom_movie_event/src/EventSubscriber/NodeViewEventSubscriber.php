<?php

namespace Drupal\custom_movie_event\EventSubscriber;

use Drupal\custom_movie_event\Event\NodeViewEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @package Drupal\custom_movie_event\EventSubscriber
 */
class NodeViewEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      NodeViewEvent::EVENT_NAME => 'onNodeLoad',
    ];
  }

  /**
   * Function to get movie budget configuration.
   * 
   * @return int
   *   Returns movie budget amount from configuration.
   */
  public function getBudget() {
    $config = \Drupal::config('movie_budget.settings');
    return $config->get('budget');
  }

  /**
   * Function to message whether the current node movie is over/under/within
   * budget.
   * 
   * @param \Drupal\custom_movie_event\Event\NodeViewEvent $event
   */
  public function onNodeLoad(NodeViewEvent $event) {
    if ($event->entity->bundle() === 'movie') {
      $budget = $this->getBudget();
      $movie_price = $event->entity->get('field_movie_price')->getValue()[0]['value'];
      // Check if movie budget is greater than budget amount.
      if ($movie_price > $budget) {
        $message = 'over';
      }
      // Check if movie budget is less than budget amount.
      elseif ($movie_price < $budget) {
        $message = 'under';
      }
      // Check if moive budget is equal to budget amount.
      else {
        $message = 'within';
      }

      \Drupal::messenger()->addStatus(t('Budget: The movie is <strong>' . $message . '</strong> budget!'));
    }
  }

}
