<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

namespace Core;

class BaseEntity {
  /**
   * @param BaseEntityManager $manager
   */
  public function __construct($manager) {
    $this->manager = $manager;
  }

  /**
   * @return int
   */
  public function save () {
    $where = array('id' => $this->id);
    $data = $this->getMysqlData();
    if ($this->id) {
      # Обновляем уже существующую сущность
      return $this->manager->db->update($where, $data);
    }
    # Добавляем новую сущность
    return $this->manager->db->insert($data);
  }

  /**
   * @return array
   * @throws \Exception
   */
  protected function getMysqlData () {
    return $this->_data;
  }

  /**
   * @param string $field
   * @return mixed
   * @throws \Exception
   */
  public function __get ($field) {
    if (array_key_exists($field, $this->_data)) {
      return $this->_data[$field];
    }
    throw new \Exception("Unknown property $field");
  }

  /**
   * @param string $field
   * @param mixed $value
   * @return $this
   * @throws \Exception
   */
  public function __set ($field, $value) {
    if (array_key_exists($field, $this->_data)) {
      $this->_data[$field] = $value;
      return $this;
    }
    throw new \Exception("Unknown property $field");
  }

  /**
   * @var array
   */
  protected $_data;

  /**
   * @var BaseEntityManager
   */
  protected $manager;
}