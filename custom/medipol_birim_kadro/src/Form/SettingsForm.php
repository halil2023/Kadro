<?php

namespace Drupal\medipol_birim_kadro\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\field\Entity\FieldConfig;

/**
 * Configure custom settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  private $statuses = [];

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'medipol_birim_kadro_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['medipol_birim_kadro.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('medipol_birim_kadro.settings');

    $form['base_url'] = [
      '#type' => 'textfield',
      '#title' => t('Email sending is active'),
      '#description' => t('If checked, there will be mail output from the system in case of status changes.'),
      '#default_value' => $config->get('base_url'),
    ];
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $configs = $this->config('medipol_birim_kadro.settings');
    $configs->set('base_url', $form_state->getValue('base_url'));
    $configs->save();
    parent::submitForm($form, $form_state);
  }

}
