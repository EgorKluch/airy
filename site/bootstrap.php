<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 11.06.2014
 */

namespace Site;

global $app;

spl_autoload_register(function ($class) {
  $parts = explode('\\', $class);
  if ('Site' === $parts[0]) {
    $parts[0] = 'site';
    $path = implode('/', $parts) . '.php';
    require_once ROOT_DIR . $path;
  }
});

$app->regManager('user', 'Site\Entity\UserManager');
