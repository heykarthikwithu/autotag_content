<?php

/**
 * @file
 * Contains \Drupal\autotag_content\Plugin\Field\FieldFormatter\AutotagContentFieldFormatter.
 */

namespace Drupal\autotag_content\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'autotag_content_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "autotag_content_field_formatter",
 *   label = @Translation("Autotag content field formatter"),
 *   field_types = {
 *     "text_with_summary"
 *   }
 * )
 */
class AutotagContentFieldFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      // Implement default settings.
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return array(
      // Implement settings form.
      $form['custom_settings'] = array(
        '#type' => 'select',
        '#options' => array_merge(['Select'], taxonomy_vocabulary_get_names()),
        '#title' => 'Select the Vocabularies to autotag.',
      ),
    ) + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $aa = $this->getFieldSettings();

    foreach ($items as $delta => $item) {
      $elements[$delta] = ['#markup' => $this->viewValue($item)];

      $value = $this->viewValue($item);
      $values = explode(" ", $value);

      $a = '';
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}
