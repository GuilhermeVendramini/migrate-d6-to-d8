<?php

namespace Drupal\migrate_cnc\Plugin\migrate\source;

use Drupal\Core\Database\Database;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;
use Drupal\node\Plugin\migrate\source\d6\Node;

/**
 * Source plugin for the cnc_tags.
 *
 * @MigrateSource(
 *   id = "cnc_ct_page"
 * )
 */
class CncCtPage extends Node {

  /**
   * {@inheritdoc}
  */
  public function prepareRow(Row $row) {
    /**
     * Recupera os termos atrelados ao node
     */
    print_r($row->getSourceProperty('nid'));
    $query = $this->select('term_data', 'td')
                 ->fields('td', ['tid']);

    $query ->join('term_node', 'tn', 'tn.tid = td.tid');
    $query ->condition('tn.nid', $row->getSourceProperty('nid'));
    $query ->condition('td.vid', 6);
    $terms = $query ->execute()->fetchCol();
    print_r($terms);
    //Atribui os termos ao campo tags
    $row->setSourceProperty('tags', $terms);

    return parent::prepareRow($row);
  }
}
