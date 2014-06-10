<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

use Slim\Slim;
use EgorKluch\MysqlQueryBuilder;

class SlimExtension extends Slim {
  public function __construct() {
    $options = $this->getConfig('slim');
    parent::__construct($options);

    $options = $this->getConfig('db');
    $this->db = new MysqlQueryBuilder($options);
  }

  /**
   * @param string $confName
   * @return array
   */
  public function getConfig ($confName) {
    return require ROOT_DIR . "config/$confName.php";
  }

  /**
   * @var MysqlQueryBuilder
   */
  public $db;
}
