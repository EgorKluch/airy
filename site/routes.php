<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 11.06.2014
 */

global $app;

$app->get('/signUp', 'user:signUp');
$app->get('/signIn', 'user:signIn');
$app->get('/signOut', 'user:signOut');
