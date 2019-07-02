<?php

require_once __DIR__.'/init.php';
require_once 'Auth_class.php';

Authentication::Register();

echo $twig->render('register.html');