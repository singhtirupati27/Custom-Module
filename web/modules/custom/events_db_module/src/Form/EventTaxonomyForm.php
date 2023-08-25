<?php

namespace Drupal\events_db_module\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * EventTaxonomyForm class to get taxonomy term and fetch it's related data.
 */
class EventTaxonomyForm extends FormBase {

  /**
   * Stores database connection object.
   *
   * @var \Drupal\Core\Database\Connection $connection
   */
  protected $connection;

  /**
   * Stores messenger object.
   *
   * @var \Drupal\Core\Messenger\Messenger $message
   */
  protected $message;

  /**
   * Constructor to initialize database connection object.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   Holds database connection object.
   * @param \Drupal\Core\Messenger\Messenger $message
   *   Holds messenger object.
   */
  public function __construct(Connection $connection, Messenger $message) {
    $this->connection = $connection;
    $this->message = $message;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('messenger'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'events_db_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['event_taxonomy_term'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Taxonomy Term'),
      '#placeholder' => 'Enter taxonomy term.',
      '#required' => TRUE,
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (empty($form_state->getValue('event_taxonomy_term'))) {
      $form_state->setErrorByName('event_taxonomy_term', $this->t('Field cannot be empty.'));
    }
    if (!$this->fetchTaxonomyData($form_state->getValue('event_taxonomy_term'))) {
      $form_state->setErrorByName('event_taxonomy_term', $this->t('Taxonomy term doesn\'t exists'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $term_data = $this->fetchTaxonomyData($form_state->getValue('event_taxonomy_term'));
    if (!empty($term_data)) {
      foreach ($term_data as $data) {
        $this->message->addMessage($this->t('The term ID is: %id', ['%id' => $data->tid]));
        $this->message->addMessage($this->t('The term UUID is: %uuid', ['%uuid' => $data->uuid]));
        $this->message->addMessage($this->t('The term title is: %title', ['%title' => $data->name]));
        $this->message->addMessage($this->t('The node title using the Term is: %term', ['%term' => $data->title]));
        $nodeUrl = Url::fromUri('internal:/node/' . $data->nid)->toString();
        $url = $this->t('<a href="@url">Node URL</a>', ['@url' => $nodeUrl]);
        $this->message->addMessage($this->t('The node URL is: %data', ['%data' => $url]));
      }
    }
    else {
      $this->message->addMessage($this->t('Invalid Taxonomy term!'));
    }
  }

  /**
   * Function to fetch passed taxonomy term related data like node using term,
   * it's id, uuid.
   *
   * @param string $taxonomy_term
   *   Taxonomy term
   *
   * @return array
   */
  public function fetchTaxonomyData($taxonomy_term) {
    $query = $this->connection->select('taxonomy_term_data', 'ttd');
    $query->innerJoin('taxonomy_term_field_data', 'ttfd', 'ttd.tid = ttfd.tid');
    $query->innerJoin('taxonomy_index', 'ti', 'ti.tid = ttfd.tid');
    $query->innerJoin('node_field_data', 'nfd', 'nfd.nid = ti.nid');
    $query->fields('ttd', ['tid', 'uuid'])
      ->fields('ttfd', ['name'])
      ->fields('nfd', ['title'])
      ->fields('nfd', ['nid'])
      ->condition('ttfd.name', $taxonomy_term);
    return $query->execute()->fetchAll();
  }

}

