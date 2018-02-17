<?php

/**
 * @file
 * Contains tpo_popup.page.inc.
 *
 * Page callback for Popup entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Popup templates.
 *
 * Default template: tpo_popup.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_tpo_popup(array &$variables) {
  // Fetch Popup Entity Object.
  $tpo_popup = $variables['elements']['#tpo_popup'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
