<?php

namespace Drupal\pavilion\Form;

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
    ];

    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#placeholder' => $this->t('9123456780.'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#placeholder' => $this->t('Enter your email'),
      '#required' => TRUE,
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
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // List of accepted domains.
    $acceptedDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
    $email = $form_state->getValue('email');

    // Check if field is empty or not.
    if (!empty($form_state->getValue('phone'))) {
      // Check if phone pattern is match or not.
      if (!preg_match('/^[0-9]{10}+$/', $form_state->getValue('phone'))) {
        $form_state->setErrorByName('phone', $this->t('Invalid phone number provided.'));
      }
    }
    // Check if field id empty.
    else {
      $form_state->setErrorByName('phone', $this->t('Phone number field cannot be empty!'));
    }

    // Check if field is empty or not.
    if(!empty($form_state->getValue('email'))) {
      // Check for valid email domains.
      if (!in_array(substr($email, strrpos($email, '@') + 1), $acceptedDomains)) {
        $form_state->setErrorByName('email', $this->t('Not accepted domain.'));
      }
      // Check if provided pattern match or not.
      if (!preg_match('/^[A-Za-z0-9+_.-]+@(.+)$/', $form_state->getValue('email'))) {
        $form_state->setErrorByName('email', $this->t('Enter valid email address.'));
      }
    }
    // If field is empty then provide message.
    else {
      $form_state->setErrorByName('email', $this->t('Email field cannot be empty.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)  {
    $this->messenger()->addStatus($this->t('You have successfully submitted the form!'));

    // Display the submitted values.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . $value);
    }
  }

}
