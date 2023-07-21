<?php

namespace Drupal\my_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\my_service\LoggedInUser;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyServiceController extends ControllerBase {

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
  public function __construct(LoggedInUser $account) {
    $this->account = $account;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('my_service.logged_in_user')
    );
  }

  /**
   * Returns a simple page with currently logged in username.
   * 
   * @return array
   *   A simple renderable array.
   */
  public function welcomePage() {
    $user = $this->account->getUserName();

    return [
      '#markup' => t('Hi <strong>' . strtoupper($user) . '</strong>')
    ];
  }

}
