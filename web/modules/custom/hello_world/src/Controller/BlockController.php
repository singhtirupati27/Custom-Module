<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

class BlockController extends ControllerBase {
  public function welcomeBlock() {
    $user = \Drupal::currentUser()->getDisplayName();
    return [
      '#markup' => t('Hello <strong>' . $user . '</strong> to Hello World Module'),
    ];
  }

}
