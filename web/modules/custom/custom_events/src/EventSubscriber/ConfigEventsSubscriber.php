<?php

namespace Drupal\custom_events\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ConfigEventsSubscriber.
 * 
 * @package Drupal\custom_events\EventSubscriber
 */
class ConfigEventsSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   * 
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents() {
    return [
      ConfigEvents::SAVE => 'configSave',
      ConfigEvents::DELETE => 'configDelete',
    ];
  }

  /**
   * Reacts to a config object being saved.
   * 
   * @param Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configSave(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('Your configuration has been saved. Config: ' . $config->getName());
  }

  /**
   * Reacts to a config object being deleted.
   * 
   * @param Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configDelete(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('Your configuration has been deleted. Config: ' . $config->getName());
  }

}
