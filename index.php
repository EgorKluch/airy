<?php
/**
 * @author EgorKluch (EgorKluch@gmail.com)
 * @date: 09.06.2014
 */

namespace Airy;

error_reporting(E_ALL ^ E_STRICT);

define('AIRY_ROOT_DIR', __DIR__ . '/');

session_start();

require 'vendor/autoload.php';
require 'core/Airy.php';

require 'core/bootstrap/index.php';

require 'site/bootstrap.php';
