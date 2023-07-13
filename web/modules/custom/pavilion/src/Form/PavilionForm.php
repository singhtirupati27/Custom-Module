<?php

namespace Drupal\pavilion\Form;

use Drupal\Component\Utility\Html;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements pvilion form.
 */
class PavilionForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pavilion_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#placeholder' => $this->t('Enter your full name.'),
      '#required' => TRUE,
      '#suffix' => '<div class="pav-error" id="full_name"></div>'
    ];
    
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#placeholder' => $this->t('9123456780.'),
      '#required' => TRUE,
      '#suffix' => '<div class="pav-error" id="phone"></div>'
    ];
    
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#placeholder' => $this->t('Enter your email'),
      '#required' => TRUE,
      '#suffix' => '<div class="pav-error" id="email"></div>'
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Gender'),
      '#options' => [
        'male' => $this->t('Male'),
        'female' => $this->t('Female'),
        'other' => $this->t('Other'),
      ],
      '#required' => TRUE,
    ];

    $form['country'] = [
      '#type' => 'radios',
      '#title' => $this->t('Country'),
      '#options' => [
        'india' => $this->t('India'),
        'us' => $this->t('US'),
        'other' => $this->t('Other'),
        'custom' => $this->t('Custom'),
      ],
      '#attributes' => [
        'id' => 'field_country_select',
      ],
      '#states' => [
        'enabled' => [
          ':input[id="other_country"]' => ['value' => ''],
        ],
      ],
    ];

    $form['choice_select'] = [
      '#type' => 'radios',
      '#title' => $this->t('Do you want to select other country?'),
      '#options' => [
        'yes' => $this->t('Yes'),
        'no' => $this->t('No'),
      ],
      '#attributes' => [
        'id' => 'field_choice_select',
      ],
      '#states' => [
        'visible' => [
          ':input[id="field_country_select"]' => [
            ['value' => 'other'],
            'or',
            ['value' => 'custom'],
          ],
        ],
      ],
    ];

    $form['other_country'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'Enter your country',
      '#attributes' => [
        'id' => 'other_country',
      ],
      '#states' => [
        'visible' => [
          ':input[id="field_country_select"]' => [
            ['value' => 'other'],
            'or',
            ['value' => 'custom'],
          ],
          'and',
          ':input[id="field_choice_select"]' => [
            'value' => 'yes',
          ],
        ],
      ],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::validateFormData',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)  {
    $this->messenger()->addStatus($this->t('You have successfully submitted the form!'));
  }

  /**
   * Function to validate form data and return error message using ajax response
   * if any error found in input data.
   * 
   * @param array $form
   *   Contain structure of the form.
   * 
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * 
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function validateFormData(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();

    // List of accepted domains.
    $acceptedDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
    $email = $form_state->getValue('email');

    // Check if field is empty or not.
    if (!empty($form_state->getValue('phone'))) {
      // Check if phone pattern is match or not.
      if (!preg_match('/^[0-9]{10}+$/', $form_state->getValue('phone'))) {
        return $ajax_response->addCommand(new HtmlCommand('#phone', 'Invalid phone number provided.'));
      }
    }
    else {
      return $ajax_response->addCommand(new HtmlCommand('#phone', 'Phone number field cannot be empty.'));
    }

    // Check if field is empty or not.
    if (!empty($form_state->getValue('email'))) {
      // Check for valid email domains.
      if (!in_array(substr($email, strrpos($email, '@') + 1), $acceptedDomains)) {
        return $ajax_response->addCommand(new HtmlCommand('#email', 'This domain is not accepted.'));
      }
      // Check if provided pattern match or not.
      if (!preg_match('/^[A-Za-z0-9+_.-]+@(.+)$/', $form_state->getValue('email'))) {
        return $ajax_response->addCommand(new HtmlCommand('#email', 'Please enter valid email address.'));
      }
    }
    else {
      return $ajax_response->addCommand(new HtmlCommand('#email', 'Email field cannot be empty.'));
    }
  }

}
