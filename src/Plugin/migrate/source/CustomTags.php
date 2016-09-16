<?php

namespace Drupal\migrate_custom\Plugin\migrate\source;

use Drupal\Core\Database\Database;
use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for the custom_tags.
 *
 * @MigrateSource(
 *   id = "custom_tags"
 * )
 */
class customTags extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {

    $query = $this->select('term_data', 't')
      ->fields('t', ['tid', 'name'])
      ->condition('vid', 6);

    return $query;
  }
  
  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'tid' => $this->t('Term ID'),
      'name' => $this->t('Term name'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'tid' => [
        'type' => 'integer',
        'alias' => 't',
      ],
    ];
  }
}
