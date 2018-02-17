<?php

namespace Drupal\tpo_themekit;

/**
 * Class DefaultService.
 *
 * @package Drupal\MyTwigModule
 */
class TIDtoNameTwigExtension extends \Twig_Extension {

  /**
   * {@inheritdoc}
   * This function must return the name of the extension. It must be unique.
   */
  public function getName() {
    return 'custom_tid_to_name';
  }

  /**
   * In this function we can declare the extension function
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('custom_tid_to_name',
        array($this, 'custom_tid_to_name'),
        array('is_safe' => array('html')
      )),);
  }

  /**
   * The php function to load a given block
   */
  public function custom_tid_to_name($tid) {
    $term_object  = taxonomy_term_load($tid);
    if ($term_object){
      return $term_object->get('name')->value;
    }
    return '';
  }
}
