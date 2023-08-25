<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides route responses for the Hello World module.
 */
class WelcomeController extends ControllerBase {

  /**
   * The current user account.
   * 
   * @var Drupal\Core\Session\AccountInterface $account
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
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user')
    );
  }

  /**
   * Returns a simple page.
   * 
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {
    $name = $this->account->getDisplayName();
    return ['#markup' => 'Hello <strong>'. strtoupper($name) . '</strong> from Hello World Module.'];
  }

}
