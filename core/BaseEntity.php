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
    throw new \Exception('Method should be overwritten by in child class.');
  }

  /**
   * Самое часто встречающееся поле. Введено для удобства
   * В некоторых случаях, например в случае таблицы многие ко многим,
   *   может не использоваться
   * @var int
   */
  protected $id;

  /**
   * @var BaseEntityManager
   */
  protected $manager;
}