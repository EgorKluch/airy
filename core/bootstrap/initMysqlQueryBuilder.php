<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

use EgorKluch\MysqlQueryBuilder;

$app->container->singleton('db', function () use ($app) {
  $conf = $app->getConfig('db');
  return new MysqlQueryBuilder($conf);
});
