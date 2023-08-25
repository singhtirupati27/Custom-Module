<?php

namespace Drupal\events_db_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * EventDashboard class to display events list.
 */
class EventDashboardController extends ControllerBase {

  /**
   * Database connection object.
   *
   * @var \Drupal\Core\Database $connection
   */
  protected $connection;

  /**
   * Constructor to instantiate database connection.
   *
   * @param \Drupal\Core\Database $connection
   *   Stores database connection instance.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
    );
  }

  /**
   * Funtion to fetch event details in event per year, event per quarter and
   * event per event type.
   *
   * @return array
   *   Returns a markup array to render event details.
   */
  public function eventsList() {
    $query = $this->connection->query("SELECT YEAR(field_event_date_value) AS year, COUNT(*) AS yearly_events
      FROM {node__field_event_date}
      INNER JOIN {node__field_event_type}
      ON {node__field_event_date}.entity_id = {node__field_event_type}.entity_id
      GROUP BY YEAR(field_event_date_value)");
    $yearly_events = $query->fetchAll();

    $query = $this->connection->query("SELECT EXTRACT(QUARTER FROM {field_event_date_value}) AS quarter, COUNT(*) AS quarterly_events
      FROM {node__field_event_date}
      INNER JOIN {node__field_event_type}
      ON {node__field_event_date}.entity_id = {node__field_event_type}.entity_id
      GROUP BY EXTRACT(QUARTER FROM {field_event_date_value})
      ORDER BY quarter ASC");
    $quarterly_events = $query->fetchAll();

    $query = $this->connection->query("SELECT field_event_type_value, COUNT(field_event_type_value) AS event_type
      FROM {node__field_event_type}
      GROUP BY field_event_type_value");
    $event_type = $query->fetchAll();

    return [
      '#theme' => "event_dashboard",
      '#yearly_event' => $yearly_events,
      '#quarterly_event' => $quarterly_events,
      '#event_type' => $event_type,
      '#cache' => [
        'tags' => ['node_list:event'],
      ],
    ];
  }

}
