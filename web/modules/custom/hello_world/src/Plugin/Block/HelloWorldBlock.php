<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides 'HelloWorld' block.
 *  
 * @Block(
 *  id = "hello_world_block",
 *  admin_label = @Translation("Hello World Block"),
 *  category = @Translation("Hello World"),
 * )
 */
class HelloWorldBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello World, this is the FT2023-363 task.'),
      '#theme' => 'hello_world_block',
      '#data' => [
        'msg' => $this->t('Hello World Block.'),
        'mod' => $this->t('Module 4'),
        'phase' => $this->t('Drupal Backend'),
      ],
    ];
  }

}
