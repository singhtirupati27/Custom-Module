<?php

namespace Drupal\rgb_color\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of 'RGB Color' field type.
 * 
 * @FieldType(
 *   id = "rgb_color",
 *   label = @Translation("RGB Color"),
 *   description = @Translation("Provides field to store color."),
 *   category = @Translation("Custom Field Type"),
 *   module = "rgb_color",
 *   default_widget = "rgb_widget",
 *   default_formatter = "rgb_hex_formatter"
 * )
 */
class RgbColor extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'hex_code' => [
          'type' => 'varchar',
          'length' => 10,
          'not null' => FALSE,
        ],
        'red' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
        'green' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
        'blue' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['hex_code'] = DataDefinition::create('string')
      ->setLabel(t('HEX'));
    
    $properties['red'] = DataDefinition::create('integer')
      ->setLabel(t('Red'))
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);

    $properties['green'] = DataDefinition::create('integer')
      ->setLabel(t('Green'))
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);
    
    $properties['blue'] = DataDefinition::create('integer')
      ->setLabel('Blue')
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);
    
    return $properties;
  }

}
