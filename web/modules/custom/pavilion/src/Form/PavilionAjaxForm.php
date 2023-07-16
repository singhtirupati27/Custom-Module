<?php

namespace Drupal\pavilion\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;

/**
 * Provides default form.
 */
class PavilionAjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pavilion_ajax_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['tech_stack'] = [
      '#type' => 'select',
      '#title' => $this->t('Select tech stacks'),
      '#options' => [
        'html' => $this->t('HTML'),
        'css' => $this->t('CSS'),
        'js' => $this->t('JavaScript'),
        'php' => $this->t('PHP'),
        'drupal' => $this->t('Drupal'),
      ],
      '#ajax' => [
        'callback' => '::myAjaxCallback',
        'disable-refocus' => FALSE,
        'event' => 'change',
        'wrapper' => 'edit-output',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Verifying entry..'),
        ],
      ],
    ];

    $form['output'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#disabled' => 'TRUE',
      '#value' => 'Ajax in Form',
      '#prefix' => '<div id="edit-output">',
      '#suffix' => '</div>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    // Check if there's a value submitted for the select list.
    if($selectedValue = $form_state->getValue('tech_stack')) {
      $selectedText = $form['tech_stack']['#options'][$selectedValue];
      $form['output']['#value'] = $selectedText;
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage($this->t('Your response has been submitted successfully.'));
  }

  /**
   * Function to get the value from tech stack field and fill the textarea with
   * the select value.
   * 
   * @param array $form
   *   Contain structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * 
   * @return array
   */
  public function myAjaxCallback(array &$form, FormStateInterface $form_state) {
    return $form['output'];
  }

}
