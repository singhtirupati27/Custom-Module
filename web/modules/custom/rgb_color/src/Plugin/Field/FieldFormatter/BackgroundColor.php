<?php

namespace Drupal\rgb_color\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Template\Attribute;

/**
 * Background color formatter for rgb color.
 * 
 * @FieldFormatter(
 *   id = "background_color_formatter",
 *   label = @Translation("Background color"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */
class BackgroundColor extends FormatterBase {

  /** 
   * {@inheritdoc}
  */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    $attributes = new Attribute();
    foreach ($items as $delta => $item) {
      if ($items->hex_code) {
        $rgb_color = $items->hex_code;
        $attributes->setAttribute('style', 'background-color: ' . $rgb_color);
        $element[$delta] = [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#value' => $rgb_color,
          '#attributes' => $attributes->toArray(),
        ];
      }
      else {
        $rgb_color = 'RGB:(' . $item->red . ', ' . $item->green . ', ' . $item->blue . ')';
        $attributes->setAttribute('style', 'background-color: ' . $rgb_color);
        $element[$delta] = [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#value' => $rgb_color,
          '#attributes' => $attributes->toArray(),
        ];
      }
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Shows the selected color as background color.');
    return $summary;
  }

}
