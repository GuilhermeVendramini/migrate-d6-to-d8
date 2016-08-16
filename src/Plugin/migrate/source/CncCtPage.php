<?php

namespace Drupal\migrate_cnc\Plugin\migrate\source;

use Drupal\Core\Database\Database;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for the cnc_tags.
 *
 * @MigrateSource(
 *   id = "cnc_ct_page"
 * )
 */
class CncCtPage extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {

    $query = $this->select('node', 'n')
      ->fields('n', ['nid', 'title']);
    $query->join('node_revisions', 'nr', 'nr.nid = n.nid');
    $query->fields('nr', ['body']);
    $query->condition('n.type', 'page');

    return $query;
  }
  
  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'nid' => $this->t('NID'),
      'title' => $this->t('Title'),
      'body' => $this->t('Body'),
      /**
       * Tags não é retornado na função "query" acima
       * seu valor é recupera na função prepareRow
      */
      'tags' => $this->t('Tags'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'nid' => [
        'type' => 'integer',
        'alias' => 'n',
      ],
    ];
  }

    /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    /**
     * Recupera os termos atrelados ao node
     */
    $query = $this->select('term_data', 'td')
                 ->fields('td', ['tid']);

    $query ->join('term_node', 'tn', 'tn.tid = td.tid');
    $query ->condition('tn.nid', $row->getSourceProperty('nid'));
    $query ->condition('td.vid', 6);
    $terms = $query ->execute()->fetchCol();

    //Atribui os termos ao campo tags
    $row->setSourceProperty('tags', $terms);

    return parent::prepareRow($row);
  }
}
