<?php

namespace Drupal\pavilion\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures pavilion's module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pavilion_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'pavilion.admin_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('pavilion.admin_settings');
    $form['pavilion_setting'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Setting for Pavilion module.'),
      '#placeholder' => $this->t('Enter settings for Pavilion module.'),
      '#default_value' => $config->get('pavilion_setting'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('pavilion.admin_settings')
      ->set('pavilion_setting', $form_state->getValue('pavilion_setting'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
