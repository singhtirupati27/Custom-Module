<?php

namespace Drupal\movie_budget\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for Movie budget.
 */
class MovieBudgetForm extends ConfigFormBase {

  /** 
   * Configuration settings.
   * 
   * @var string
  */
  const SETTINGS = 'movie_budget.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'movie_budget_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $form['budget'] = [
      '#type' => 'number',
      '#title' => $this->t('Movie Budget Amount'),
      '#description' => $this->t('Budget friendly amount for the movie.'),
      '#placeholder' => $this->t('Enter movie budget amount.'),
      '#default_value' => $config->get('budget'),
      '#min' => 1,
      '#prefix' => $this->t('Rs'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      ->set('budget', $form_state->getValue('budget'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
