<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

$app->getConfig = $app->container->protect(function ($confName) {
  return require ROOT_DIR . "config/$confName.php";
});
