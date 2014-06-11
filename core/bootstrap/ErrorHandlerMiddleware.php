<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

namespace Airy;

use Slim\Middleware;
use Slim\Slim;

class ErrorHandlerMiddleware extends Middleware {
  public function call() {
    try {
      $this->next->call();
    }
    catch (\Exception $e) {
      Slim::getInstance()->error($e);
    }
  }
}

$app = Airy::getInstance();

/**
 * Default error handler
 */
$app->error(function ($e) {
  throw $e;
});
