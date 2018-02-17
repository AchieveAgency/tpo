<?php

/**
 * @file
 * Contains tpo_campaign.page.inc.
 *
 * Page callback for Campaign entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Campaign templates.
 *
 * Default template: tpo_campaign.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_tpo_campaign(array &$variables) {
  // Fetch Campaign Entity Object.
  $tpo_campaign = $variables['elements']['#tpo_campaign'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
