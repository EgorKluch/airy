<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

use Core\ErrorHandlerMiddleware;

error_reporting(E_ALL ^ E_STRICT);

define('ROOT_DIR', __DIR__ . '/');

session_start();

require 'vendor/autoload.php';
require 'core/SlimExtension.php';

$app = new SlimExtension();

require 'core/bootstrap/index.php';
require 'site/bootstrap.php';

# Загружаем middleware в порядке, обратном их запуску
$app->add(new ErrorHandlerMiddleware());

$app->get('/', function () use ($app) {
  /** @var \Site\Entity\UserManager $userManager */
  $userManager = $app->getManager('user');
  var_dump($userManager->currentUser);
});

$app->get('/registration', function () use ($app) {
  $data = array (
    'login' => 'EgorKluch',
    'password' => 'password',
    'email' => 'EgorKluch@gmail.com',
    'roles' => 'user'
  );
  /** @var \Site\Entity\UserManager $userManager */
  $userManager = $app->getManager('user');
  $userManager->signUp($data);
});

$app->run();
