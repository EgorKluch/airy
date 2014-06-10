<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

use Slim\Slim;
use EgorKluch\MysqlQueryBuilder;

require 'vendor/autoload.php';

$app = new Slim();

$conf = require __DIR__ . '/config/db.php';
$app->db = new MysqlQueryBuilder($conf['db'], $conf['user'], $conf['pass'], $conf['host']);

$app->get('/hello/:name', function ($name) {
  echo "Hello, $name";
});

$app->run();
