<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

use Slim\Slim;

define('ROOT_DIR', __DIR__ . '/');

require 'vendor/autoload.php';

$app = new Slim(array( 'debug' => false ));

# Подгружаем дополнительные методы, расширяющие объект $app
require 'core/bootstrap/initExtensionMethods.php';
# Подгружаем библиотеку, предоставляющую удобный интерфейс для доступа к БД
require 'core/bootstrap/initMysqlQueryBuilder.php';
# Подгружаем Middleware класс для обработки ошибок
require 'core/bootstrap/ErrorHandlerMiddleware.php';

# Загружаем middleware в порядке, обратном их запуску
$app->add(new ErrorHandlerMiddleware());

$app->run();
