<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 */

namespace Core;

use Slim\Middleware;
use Slim\Slim;

global $app;

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

/**
 * Default error handler
 */
$app->error(function ($e) {
  throw $e;
});
