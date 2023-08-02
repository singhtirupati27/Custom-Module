<?php

namespace Drupal\my_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a "MyModuleBlock".
 * 
 * @Block(
 *  id = "mymodule_block",
 *  admin_label = "MyModule Block",
 *  category = "MyModule",
 * )
 */
class MyModuleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('My first custom block.'),
    ];
  }

}
