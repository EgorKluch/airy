<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

define('ROOT_DIR', __DIR__ . '/');

require 'vendor/autoload.php';
require 'core/SlimExtension.php';

session_start();

$app = new SlimExtension();

# Подгружаем Middleware класс для обработки ошибок
require 'core/bootstrap/ErrorHandlerMiddleware.php';

# Загружаем middleware в порядке, обратном их запуску
$app->add(new ErrorHandlerMiddleware());

$app->get('/', function () use ($app) {
  $app->db->select('test_table', array());
});

$app->run();
