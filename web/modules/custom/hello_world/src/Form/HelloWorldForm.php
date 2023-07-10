<?php

  namespace Drupal\hello_world\Form;

  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;

  class HelloWorldForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'hello_world_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $form['name'] = array (
        '#type'=> 'textfield',
        '#title' => t('Enter Name'),
        '#placeholder' => t('Enter your name.'),
        '#required' => TRUE,
      );

      $form['email'] = array (
        '#type' => 'email',
        '#title' => t('Enter email'),
        '#placeholder' => t('Enter your e-mail'),
        '#required' => TRUE,
      );

      $form['phone'] = array (
        '#type' => 'tel',
        '#title' => t('Enter phone number'),
        '#placeholder' => t('9123456780'),
        '#required' => TRUE,
      );

      $form['department'] = array (
        '#type' => 'textfield',
        '#title' => t('Department'),
        '#placeholder' => t('Enter your department'),
      );

      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = array (
        '#type' => 'submit',
        '#value' => $this->t('Register'),
        '#button_type' => 'primary',
      ); 

      return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('phone')) < 10) {
        $form_state->setErrorByName('phone', $this->t('Enter valid phone number.'));
      } 
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      \Drupal::messenger()->addMessage(t("Form has been submitted successfully! Submitted values are:"));
      foreach ($form_state->getValues() as $key => $value) {
        \Drupal::messenger()->addMessage($key . ':' . $value);
      }
    }
  }
?>
