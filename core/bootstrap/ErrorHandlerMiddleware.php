<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 10.06.2014
 *
 * Внимание! Обрыботчик $app->error($errorHandler) не установлен,
 *    для каждого проекта реализуется самостоятельно!
 * Без обработчика будет вызываться метод $app->stop()
 */

use Slim\Slim;

class ErrorHandlerMiddleware extends \Slim\Middleware {
  public function call() {
    try {
      $this->next->call();
    }
    catch (\Exception $e) {
      Slim::getInstance()->error($e);
    }
  }
}
