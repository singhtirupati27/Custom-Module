<?php

namespace Drupal\sample_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Sample controller.
 */
class SampleController extends ControllerBase {

  /**
   * Returns renderable array.
   * 
   * @return array
   */
  public function content() {
    $build = [
      '#markup' => t('Hello from Routing!'),
    ];

    $mytext = 'Practicing routing in drupal.';
    $drupalVersion = 10 ;
    $myArray = [8, 9, 10];
    
    return [
      '#theme' => 'sample_module_theme_hook',
      '#variable1' => t($mytext),
      '#variable2' => $drupalVersion,
      '#variable3' => $myArray,
    ];
  }

}
