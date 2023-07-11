<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route and responses for my_module module.
 */
class ModuleController extends ControllerBase {

  /**
   * Render hello world my page.
   * 
   * @return markup array
   */
  public function myPage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello Controller'),
    ];
  }

}
