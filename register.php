<?php

require_once __DIR__.'/init.php';
require_once 'Auth_class.php';

$auth = new Authentication();
$auth->register();

echo $twig->render('register.html');