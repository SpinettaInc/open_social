<?php

namespace Drupal\social_activity_filter;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Class SocialActivityFilterOverride.
 *
 * Configuration override.
 *
 * @package Drupal\social_event_type
 */
class SocialActivityFilterOverride implements ConfigFactoryOverrideInterface {

  /**
   * Load overrides.
   */
  public function loadOverrides($names) {
    $overrides = [];

    // Override activity_stream views.
    $config_name = 'views.view.activity_stream';

    if (in_array($config_name, $names)) {

      $data = [
        'id' => 'activity_filter_tags',
        'table' => 'activity',
        'field' => 'activity_filter_tags',
        'relationship' => 'none',
        'group_type' => 'group',
        'admin_label' => '',
        'operator' => '=',
        'value' => '',
        'group' => 1,
        'exposed' => FALSE,
        'expose' => [
          'operator_id' => '',
          'label' => '',
          'description' => '',
          'use_operator' => FALSE,
          'operator' => '',
          'operator_limit_selection' => FALSE,
          'operator_list' => [],
          'identifier' => '',
          'required' => FALSE,
          'remember' => FALSE,
          'multiple' => FALSE,
          'remember_roles' => [
            'authenticated' => 'authenticated',
          ],
        ],
        'is_grouped' => FALSE,
        'group_info' => [
          'label' => '',
          'description' => '',
          'identifier' => '',
          'optional' => TRUE,
          'widget' => 'select',
          'multiple' => FALSE,
          'remember' => FALSE,
          'default_group' => 'All',
          'default_group_multiple' => [],
          'group_items' => [],
        ],
        'entity_type' => 'activity',
        'plugin_id' => 'activity_filter_tags',
      ];

      $overrides[$config_name] = [
        'display' => [
          'block_stream_homepage' => [
            'display_options' => [
              'filters' => [
                'activity_filter_tags' => $data,
              ],
            ],
          ],
          'block_stream_homepage_without_post' => [
            'display_options' => [
              'filters' => [
                'activity_filter_tags' => $data,
              ],
            ],
          ],
        ],
      ];
    }

    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'SocialActivityFilterOverride';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}