<?php

namespace Drupal\rgb_color\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * RGB Color widget.
 * 
 * @FieldWidget(
 *   id = "rgb_widget",
 *   label = @Translation("RGB Color"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class RgbWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['red'] = [
      '#type' => 'number',
      '#title' => $this->t('Red'),
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->red ?? NULL,
    ];

    $element['green'] = [
      '#type' => 'number',
      '#title' => $this->t('Green'),
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->green ?? NULL,
    ];

    $element['blue'] = [
      '#type' => 'number',
      '#title' => $this->t('Blue'),
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->blue ?? NULL,
    ];

    return $element;
  }























  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Take color input in RGB format.');
    return $summary;
  }

}
