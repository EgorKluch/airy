<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 11.06.2014
 */

namespace Site\User\Controller;

use Site\User\Entity\UserManager;

class UserController {
  public function signUp () {
    global $app;

    $data = array (
      'login' => 'EgorKluch',
      'password' => 'password',
      'email' => 'EgorKluch@gmail.com',
      'roles' => 'user'
    );

    /** @var UserManager $userManager */
    $userManager = $app->getManager('user');
    $userManager->signUp($data);
    $userManager->signIn($data['login'], $data['password']);
    $app->sendAjax(array('result' => 1));
  }

  public function signIn () {
    global $app;
    /** @var UserManager $userManager */
    $userManager = $app->getManager('user');
    $userManager->signIn('EgorKluch', 'password');
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
