<?php

namespace Drupal\custom_events\EventSubscriber;

use Drupal\custom_events\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @package Drupal\custom_events\EventSubscriber
 */
class UserLoginSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  /**
   * Function to show user name and account creation date on log in.
   */
  public function onUserLogin(UserLoginEvent $event) {
    $database = \Drupal::database();
    $dateFormatter = \Drupal::service('date.formatter');

    $account_created = $database->select('users_field_data', 'ud')
      ->fields('ud', ['created', 'name'])
      ->condition('ud.uid', $event->account->id())
      ->execute()
      ->fetchField();

    \Drupal::messenger()->addStatus(t('Welcome %name. Your account has been created on %create', [
      '%name' => $event->account->getDisplayName(),
      '%create' => $dateFormatter->format($account_created, 'short'),
    ]));
  }

}
