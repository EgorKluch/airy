<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 11.06.2014
 */

spl_autoload_register(function ($class) {
  $parts = explode('\\', $class);
  if ('Airy' === $parts[0]) {
    $parts[0] = 'core';
    $path = AIRY_ROOT_DIR . implode('/', $parts) . '.php';
    if (is_file($path)) {
      require_once $path;
    }
    $path = AIRY_ROOT_DIR . 'core/bootstrap/' . $parts[1] . '.php';
    if (is_file($path)) {
      require_once $path;
    }
  }
});
