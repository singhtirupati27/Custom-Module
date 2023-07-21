<?php

namespace Drupal\my_service\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\my_service\LoggedInUser;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a MyServiceBlock
 * 
 * @Block(
 *  id = "my_service_block",
 *  admin_label = @Translation("My Service Module Custom Block"),
 *  category = @Translation("My Service Block"),
 * )
 */
class MyServiceBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\my_service\LoggedInUser $userRole
   *   Holds current logged in user role.
   */
  protected $userRole;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\my_service\LoggedInUser $userRole
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, LoggedInUser $userRole) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->userRole = $userRole;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('my_service.logged_in_user')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function build() {
    $userRole = $this->userRole->getUserRole();
    $role = implode(', ', $userRole);
    $build = [
      '#type' => 'markup',
      '#markup' => t('Welcome ' . $role),
    ];
    return $build;
  }

}
