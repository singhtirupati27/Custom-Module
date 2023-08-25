<?php

namespace Drupal\my_route\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides route response for my_route module.
 */
class HomeController extends ControllerBase {

  /**
   * Return a renderable array.
   * 
   * @return array
   */
  public function contentPage() {
    return [
      '#markup' => t('Hello from my_route controller!'),
    ];
  }

  /**
   * Checks access for specific request.
   * 
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access check for this account.
   * 
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function accessCheck(AccountInterface $account) {
    return AccessResult::allowedIf($account->hasPermission('access custom page'));
  }

  public function dynamicRoute($id) {
    return [
      '#type' => 'markup',
      '#markup' => t('Hello from dynamic controller. You have pass the value in url @value', ['@value' => $id]),
    ];
  }

}
