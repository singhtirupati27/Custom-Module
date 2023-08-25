<?php

/**
 * @file providing the service that provides current logged in user name and
 * user role.
 */

namespace Drupal\my_service;

use Drupal\Core\Session\AccountInterface;

/**
 * Service class to stores current logged in user account data.
 */
class LoggedInUser {

  /**
   * The current user account.
   * 
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * Contructor to initialise account property with current user.
   * 
   * @param Drupal\Core\Session\AccountInterface $account
   *   Current logged in user data.
   */
  public function __construct(AccountInterface $account) {
    $this->account = $account;
  }

  /**
   * {@inheritdoc}
   */
  public function getUserName() {
    return $this->account->getDisplayName();
  }

  /**
   * {@inheritdoc}
   */
  public function getUserRole() {
    return $this->account->getRoles();
  }
  
}
