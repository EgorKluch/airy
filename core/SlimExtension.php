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
    $this->_managers = array();
  }

  /**
   * @param string $confName
   * @return array
   */
  public function getConfig ($confName) {
    return require ROOT_DIR . "config/$confName.php";
  }

  public function regManager ($name, $className) {
    $this->_managers[$name] = $className;
  }

  public function getManager ($name, $options = array()) {
    if (is_string($this->_managers[$name])) {
      $this->_managers[$name] = new $this->_managers[$name]($options);
    }
    return $this->_managers[$name];
  }

  /**
   * @var MysqlQueryBuilder
   */
  public $db;

  protected $_managers;
}
