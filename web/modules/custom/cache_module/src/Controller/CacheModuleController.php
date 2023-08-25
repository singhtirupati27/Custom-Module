<?php

namespace Drupal\cache_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for cache_module routes.
 */
class CacheModuleController extends ControllerBase {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The user storage.
   *
   * @var \Drupal\user\UserStorageInterface
   */
  protected $userStorage;

  /**
   * Initilize the objects.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   The current user.
   * @param \Drupal\user\UserStorageInterface $user_storage
   *   The user storage.
   */
  public function __construct(AccountProxyInterface $current_user, UserStorageInterface $user_storage) {
    $this->currentUser = $current_user;
    $this->userStorage = $user_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('entity_type.manager')->getStorage('user')
    );
  }

  /**
   * Builds the response for the welcome page.
   *
   * @return array
   *   This array contains the title and markup message.
   */
  public function build() {
    // Getting the current user entity.
    $current_user = $this->userStorage->load($this->currentUser->id());
    // Cache tag has been used to invalidate the cache when the user:1 tag is
    // changed.

    if (!\Drupal::currentUser()->isAuthenticated()) {
      $message = $this->t('Please login to view this page.');
    }
    else {
      $message = $this->t('This is the home page. Welcome @name', ['@name' => \Drupal::currentUser()->getDisplayName()]);
    }
    return [
     '#title' => $this->t('Cache practicing'),
      '#markup' => $message,
      '#cache'  => [
        'tags' => $current_user->getCacheTags(),
      ],
    ];
  }

  public function getRandomNumber() {
    return [
      '#title' => $this->t('Practicing Cache API.'),
      '#markup' => rand(1, 999),
      '#cache' => [
        'tags' => ['node:29'],
        'contexts' => ['user.roles:anonymous'],
      ],
    ];
  }

}
