<?php

namespace Drupal\custom_events\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

/**
 * Event that is fired when user logs in.
 */
class UserLoginEvent extends Event {

  /**
   * Event name.
   */
  const EVENT_NAME = 'custom_events_user_login';

  /**
   * The user account.
   * 
   * @var \Drupal\user\UserInterface $account
   */
  public $account;

  /**
   * Constructor to instantiate user object.
   * 
   * @param \Drupal\user\UserInterface $account
   *   The account of user logged in.
   */
  public function __construct(UserInterface $account) {
    $this->account = $account;
  }

}
