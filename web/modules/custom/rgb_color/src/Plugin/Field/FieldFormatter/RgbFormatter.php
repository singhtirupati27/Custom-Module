<?php

namespace Drupal\rgb_color\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * RGB color formatter.
 * 
 * @FieldFormatter(
 *   id = "rgb_hex_formatter",
 *   label = @Translation("RGB Color Hex"),
 *   field_types = {
 *     "rgb_color"
 *  }
 * )
 */
class RgbFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    foreach ($items as $delta => $item) {
      if ($items->hex_code) {
        $rgb_color = 'Hex Code: ' . $items->hex_code;
        $element[$delta] = [
          '#type' => 'markup',
          '#markup' => $rgb_color,
        ];
      }
      else {
        $rgb_color = 'RGB:(' . $item->red . ', ' . $item->green . ', ' . $item->blue . ')';
        $element[$delta] = [
          '#type' => 'markup',
          '#markup' => $rgb_color,
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
    $summary[] = t('Display color in RGB format.');
    return $summary;
  }

}
