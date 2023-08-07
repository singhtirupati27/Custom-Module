<?php

namespace Drupal\rgb_color\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Hex code color widget.
 * 
 * @FieldWidget(
 *   id = "hex_code_widget",
 *   label = @Translation("Hex Code"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class HexWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['hex_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hex Code'),
      '#size' => 7,
      '#default_value' => $items[$delta]->hex_code ?? NULL,
      '#placeholder' => $this->getSetting('placeholder'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'placeholder' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    return $summary;
  }

}
