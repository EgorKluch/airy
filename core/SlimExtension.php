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

  public function regController ($name, $className) {
    $this->_controllers[$name] = $className;
  }

  public function getController ($name) {
    if (is_string($this->_controllers[$name])) {
      $this->_controllers[$name] = new $this->_controllers[$name]();
    }
    return $this->_controllers[$name];
  }

  public function sendAjax ($data, $status = 200) {
    $data = json_encode($data);
    $this->send($data, $status);
  }

  public function send ($data, $status = 200) {
    $this->halt($status, $data);
  }

  public function get ($route, $action, $cond = array(), $name = '') {
    $this->addRoute('get', $route, $action, $cond, $name);
  }

  /**
   * @var MysqlQueryBuilder
   */
  public $db;

  protected function addRoute ($method, $route, $action, $cond, $name) {
    parent::$method($route, function () use ($action) {
      global $app;
      $action = explode(':', $action);
      $controller = $app->getController($action[0]);
      $action = $action[1];
      $controller->$action(func_get_args());
    })->conditions($cond)->name($name);
  }

  protected $_managers;

  protected $_controllers;
}
