<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

namespace Airy;

use EgorKluch\AccessManager;
use EgorKluch\AssignMysqlQueryBuilder;

class BaseEntityManager {
  public function __construct($table, $Entity) {
    $app = Airy::getInstance();
    /*
     * Если $this->accessManager === null, accessManager не инициализирован.
     * Таким образом accessManager инициализируется только для сущностей,
     *    для которых делает проверка прав в течении запроса
     */
    $this->accessManager = null;
    $this->db = $app->db->assign($table);
    $this->Entity = $Entity;
  }

  /**
   * @param string $action
   * @param array $args
   */
  public function hasAccess ($action, $args = array()) {
    if (is_null($this->accessManager)) {
      $this->accessManager = new AccessManager();
      $this->_initAccessManager();
    }
    $this->accessManager->hasAccess($action, $args);
  }

  /**
   * @param int $id
   * @param array $fields
   * @return int
   * @throws \Exception
   */
  public function edit ($id, $fields) {
    $entity = $this->getByField('id', $id);
    if (!$entity) throw new \Exception('Entity not found');
    foreach ($fields as $field => $value) {
      $entity->$field = $value;
    }
    return $entity->save();
  }

  /**
   * @param array $data
   * @return int
   */
  public function add ($data) {
    /** @var BaseEntity $entity */
    $entity = new $this->Entity($this, $data);
    return $entity->save();
  }

  /**
   * @param int $id
   * @return bool
   */
  public function del ($id) {
    $where = array('id' => $id);
    return $this->db->del($where);
  }

  /**
   * @param string $field
   * @param mixed $value
   * @param bool $rawData
   * @return BaseEntity
   */
  public function getByField ($field, $value, $rawData = false) {
    $where = array($field => $value);
    $data = $this->db->one($where);
    if ($rawData) return $data;
    return new $this->Entity($this, $data);
  }

  /**
   * Дочернии сущности чаще всего должны переорпеделить этот класс.
   *  Именно в этом методе задаются handlers и prepareHandlers для необходимых действий
   */
  protected function _initAccessManager () { }

  /**
   * @var AccessManager|null;
   */
  protected $accessManager;

  /**
   * @var AssignMysqlQueryBuilder
   */
  protected $bd;

  /**
   * @var string
   */
  protected $Entity;
}
