<?php

namespace Drupal\custom_javascript\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for custom_javascript routes.
 */
class CustomJsController extends ControllerBase {

  /**
   * Builds responses.
   */
  public function build() {
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
      '#attached' => [
        'library' => 'custom_javascript/custom_javascript_basic',
      ],
    ];

    return $build;
  }

}
