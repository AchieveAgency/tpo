<?php

namespace Drupal\tpo_social_share\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SocialShareSettingsForm.
 */
class SocialShareSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'tpo_social_share.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tpo_social_share_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('tpo_social_share.settings');

    $form['group_integration'] = [
      '#type' => 'fieldset',
      '#title' => t('Integration Options'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    ];

    $form['group_integration']['addthis_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('AddThis API Key'),
      '#description' => $this->t('From the &#039;Get The Code&#039; page on AddThis.com: the install code API key is at the end of the code snippet, under the pubid variable. It begins with &#039;ra-&#039;, followed by 16 alphanumeric characters.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('addthis_api_key') ?: 'ra-5a0b47a75629306b',
    ];

    $form['group_display'] = [
      '#type' => 'fieldset',
      '#title' => t('Display Options'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    ];

    $form['group_display']['enable_on_front'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable on front page?'),
      '#description' => $this->t('Check this box to show the floating social share buttons on the front page.'),
      '#default_value' => $config->get('enable_on_front'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('tpo_social_share.settings')
      ->set('addthis_api_key', $form_state->getValue('addthis_api_key'))
      ->set('enable_on_front', $form_state->getValue('enable_on_front'))
      ->save();
  }

}
