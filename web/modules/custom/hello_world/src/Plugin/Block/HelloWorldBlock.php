<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

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
    $hello_array = [
      0 => [
        'is_active' => 'active',
        'label' => 'Google',
        'url' => 'https://www.google.com',
      ],
      1 => [
        'is_active' => 'inactive',
        'label' => 'YouTube',
        'url' => 'https://www.youtube.com',
      ],
    ];

    return [
      '#theme' => 'hello_world_block',
      '#active_tab' => 'some_string',
      '#body_text' => [
        '#markup' => 'Block body text',
      ],
      '#data' => [
        'msg' => $this->t('Hello World Block.'),
        'mod' => $this->t('Module 4'),
        'phase' => $this->t('Drupal Backend'),
      ],
      '#tabs' => $hello_array,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {  
    return [
      'hello_world_block_name' => $this->t(''),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['hello_world_block_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Whom do you want to say hello?'),
      '#default_value' => $this->configuration['hello_world_block_name'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configuration['hello_world_block_name'] = $values['hello_world_block_name'];
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    if ($form_state->getValue('hello_world_block_name') === 'Admin') {
      $form_state->setErrorByName('hello_world_block_name', $this->t('You cannot say hello to Admin.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return \Drupal\Core\Access\AccessResult::allowedIf($account->isAuthenticated());
  }

}
