<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

namespace Airy;

error_reporting(E_ALL ^ E_STRICT);

define('ROOT_DIR', __DIR__ . '/');

session_start();

require 'vendor/autoload.php';
require 'core/Airy.php';

require 'core/bootstrap/index.php';
/*
 * $app должен загружаться в site/bootstrap.php
 * Это позволяет переопределить класс SlimExtension,
 *    добавив специфичные для проекта возможности
 */
require 'site/bootstrap.php';

$app = Airy::getInstance();

# Загружаем middleware в порядке, обратном их запуску
$app->add(new ErrorHandlerMiddleware());

$app->run();
