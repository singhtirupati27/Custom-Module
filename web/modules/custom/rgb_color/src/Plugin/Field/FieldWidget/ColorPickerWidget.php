<?php

namespace Drupal\rgb_color\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * RGB color picker Widget.
 * 
 * @FieldWidget(
 *   id = "color_picker_widget",
 *   label = @Translation("Color Picker"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class ColorPickerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $red = $items[$delta]->red ?? '00';
    $green = $items[$delta]->green ?? '00';
    $blue = $items[$delta]->blue ?? '00';
    $element['hex_code'] = [
      '#type' => 'color',
      '#default_value' => sprintf("#%02x%02x%02x", $red, $green, $blue),
    ];

    return $element;
  }

}
