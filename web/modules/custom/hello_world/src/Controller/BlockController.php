<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a controller class for Welcome Block.
 */
class BlockController extends ControllerBase {

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
   * Function to display message on block with user role.
   * 
   * @return array
   *   Returns renderable array.
   */
  public function welcomeBlock() {
    $user = $this->account->getDisplayName();
    return [
      '#markup' => $this->t('Hello <strong>' . $user . '</strong> to Hello World Module'),
    ];
  }

}
