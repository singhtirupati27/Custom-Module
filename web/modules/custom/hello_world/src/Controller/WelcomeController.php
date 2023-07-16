<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Hello World module.
 */
class WelcomeController extends ControllerBase {

  /**
   * Returns a simple page.
   * 
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {
    $user = \Drupal::currentUser();
    $name = $user->getDisplayName();
    return ['#markup' => 'Hello '. $name];
  }
}
