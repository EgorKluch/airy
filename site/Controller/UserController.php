<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 11.06.2014
 */

namespace Site\Controller;

use Site\Entity\UserManager;

class UserController {
  public function signUp () {
    global $app;
    /** @var UserManager $userManager */
    $userManager = $app->getManager('user');
    $userManager->signUp($_POST);
    $userManager->signIn($_POST['login'], $_POST['password']);
    $app->sendAjax(array('result' => 1));
  }

  public function signIn () {
    global $app;
    /** @var UserManager $userManager */
    $userManager = $app->getManager('user');
    $userManager->signIn($_POST['login'], $_POST['password']);
    $app->sendAjax(array('result' => 1));
  }

  public function signOut () {
    global $app;
    /** @var UserManager $userManager */
    $userManager = $app->getManager('user');
    $userManager->signOut();
    $app->sendAjax(array('result' => 1));
  }
}
