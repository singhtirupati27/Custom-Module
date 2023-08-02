<?php

namespace Drupal\movie_module\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Award Winning Movie form.
 *
 * @property \Drupal\movie_module\AwardWinningMovieInterface $entity
 */
class AwardWinningMovieForm extends EntityForm {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManager $entityTypeManager
   */
  protected $entityTypeManager;

  /**
   * Constructor to initialize entity type manager object.
   */
  public function __construct(EntityTypeManager $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $form['label'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Movie Name'),
      '#target_type' => 'node',
      '#description' => $this->t('Name of the award winning movie.'),
      '#required' => TRUE,
      '#default_value' => $this->entityTypeManager->getStorage('node')->load($this->entity->get('label') ?? ''),
      '#selection_settings' => [
        'target_bundles' => ['movie'],
      ],
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\movie_module\Entity\AwardWinningMovie::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['movie_year'] = [
      '#type' => 'date',
      '#title' => $this->t('Movie Year'),
      '#default_value' => $this->entity->get('movie_year'),
      '#description' => $this->t('Movie released year.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->label()];
    $message = $result == SAVED_NEW
      ? $this->t('Created new award winning movie %label.', $message_args)
      : $this->t('Updated award winning movie %label.', $message_args);
    $this->messenger()->addStatus($message);
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }

}
