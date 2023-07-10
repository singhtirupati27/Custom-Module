<?php

namespace Drupal\permission_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for sample permission page.
 */
class IndexController extends ControllerBase {

  /**
   * Render overview page.
   * 
   *  @return array
   */
  public function overviewPage() {
    $build = [];

    $build['content'] = [
      '#prefix' => '<p>',
      '#markup' => $this->t('This is overview page. You will see all the levels of permission.'),
      '#suffix' => '</p>',
    ];

    $level1_access = \Drupal::currentUser()->hasPermission('sample permission 1');
    $level2_access = \Drupal::currentUser()->hasPermission('sample permission 2');
    $level3_access = \Drupal::currentUser()->hasPermission('sample permission 3');

    if ($level1_access) {
      $build['level1'] = [
        '#prefix' => '<p>',
        '#markup' => $this->t('You have Level 1 permission access.'),
        '#suffix' => '</p>',
      ];
    }

    if ($level2_access) {
      $build['level2'] = [
        '#prefix' => '<p>',
        '#markup' => $this->t('You have Level 2 permission access.'),
        '#suffix' => '</p>',
      ];
    }

    if ($level3_access) {
      $build['level3'] = [
        '#prefix' => '<p>',
        '#markup' => $this->t('You have Level 3 permission access.'),
        '#suffix' => '</p>',
      ];
    }

    if (!$level1_access && !$level2_access && !$level3_access) {
      $build['no_access'] = [
        '#prefix' => '<p>',
        '#markup' => $this->t('You have no access permission.'),
        '#suffix' => '</p>',
      ];
    }

    return $build;
  }

  /**
   * Render array for the level1 permission page.
   * 
   *  @return array
   */
  public function level1Page() {
    $build = [];

    $build['content'] = [
      '#prefix' => '<p>',
      '#markup' => $this->t('You have Level 1 access.'),
      '#suffix' => '</p>',
    ];

    return $build;
  }

  /**
   * Render array for the level2 permission page.
   * 
   *  @return array
   */
  public function level2Page() {
    $build = [];

    $build['content'] = [
      '#prefix' => '<p>',
      '#markup' => 'You have Level 2 access',
      '#suffix' => '</p>',
    ];

    return $build;
  }
  
  /**
   * Render array for the level3 permission page.
   * 
   *  @return array
   */
  public function level3Page() {
    $build = [];

    $build['content'] = [
      '#prefix' => '<p>',
      '#markup' => 'You have Level 3 access',
      '#suffix' => '</p>',
    ];

    return $build;
  }

}

?>
