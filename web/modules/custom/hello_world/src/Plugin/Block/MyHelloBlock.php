<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides 'My Hello Block'.
 * 
 * @Block(
 *  id = "my_hello_block",
 *  admin_label = @Translation("My Hello Block"),
 *  category = @Translation("Hello World"),
 * )
 */
class MyHelloBlock extends BlockBase {
  
  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_role = \Drupal::currentUser()->getRoles();
    $user_roles = implode(', ', $current_role);
    return [
      '#markup' => $this->t('Welcome '. $user_roles),
    ];
  }

}
