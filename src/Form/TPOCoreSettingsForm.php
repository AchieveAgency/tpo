<?php

namespace Drupal\tpo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TPOCoreSettingsForm.
 */
class TPOCoreSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'tpo.tpocoresettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tpo_core_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('tpo.tpocoresettings');

    $form['group_organization'] = [
      '#type' => 'fieldset',
      '#title' => t('Organization'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    ];

    $form['group_organization']['organization_contact'] = [
      '#type' => 'address',
      '#title' => $this->t('Organization'),
      '#description' => $this->t('Street address of the organization, for use in email templates and contact page.'),
      '#default_value' => $config->get('organization_address'),
    ];
    $form['group_organization']['organization_email'] = [
      '#type' => 'email',
      '#title' => $this->t( 'Email'),
      '#default_value' => $config->get('organization_email'),
    ];
    $form['group_organization']['organization_phone_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#default_value' => $config->get('organization_phone_number'),
    ];

    $form['group_globals'] = [
      '#type' => 'fieldset',
      '#title' => t('Global Options'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    ];

    $form['group_globals']['copyright'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright'),
      '#description' => $this->t('Copyright information to be listed in the site footer.'),
      '#default_value' => $config->get('copyright') ?: 'Organization Name, All Rights Reserved',
      '#field_prefix' => '&copy;'.date('Y'),
      '#field_suffix' => '| Privacy Policy | ADA Notice | Site Map'
    ];

    $form['group_globals']['disclosures'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Disclosures'),
      '#description' => $this->t('Disclosures to be listed in the site footer.'),
      '#default_value' => $config->get('disclosures'),
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

    $this->config('tpo.tpocoresettings')
      ->set('organization_contact', $form_state->getValue('organization_contact'))
      ->set('organization_name', $form_state->getValue('organization_name'))
      ->set('organization_phone_number', $form_state->getValue('organization_phone_number'))
      ->set('organization_email', $form_state->getValue('organization_email'))
      ->set('copyright', $form_state->getValue('copyright'))
      ->set('disclosures', $form_state->getValue('disclosures'))
      ->save();
  }

}
