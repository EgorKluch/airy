<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 *
 */

namespace Site\Entity;

use Core\BaseEntity;

class User extends BaseEntity {
  public function __construct($manager, $data) {
    parent::__construct($manager);
    $this->_data = $data;
    $this->roles = explode('|', $data['roles']);
  }

  /**
   * @param string $role
   * @return bool
   */
  public function hasRole ($role) {
    return (bool) array_search($role, $this->roles);
  }

  /**
   * @param array $roles
   * @return bool
   */
  public function inRoles ($roles) {
    return (bool) array_uintersect($this->roles, $roles, "strcasecmp");
  }
} 