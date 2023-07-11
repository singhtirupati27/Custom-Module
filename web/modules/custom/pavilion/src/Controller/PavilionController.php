<?php

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller is wired
 * to Drupal in pavilion.routing.yml.
 */

namespace Drupal\pavilion\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provide route responses for pavilion module.
 */
class PavilionController extends ControllerBase {

  /**
   * Returns a simple page.
   * 
   * @return array
   *   A simple renderable array.
   */
  public function simpleContent() {
    return [
      '#type' => 'markup',
      '#markup' => t('Hello Drupal World.'),
    ];
  }

  /**
   * Returns a simple page with variable passed in the url.
   * 
   * @return array
   */
  public function variableContent($name_1, $name_2) {
    return [
      '#type' => 'markup',
      '#markup' => t('@name1 and @name2 say hello to you!', ['@name1' => $name_1, '@name2' => $name_2]),
    ];
  }

}
