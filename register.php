<?php

require_once __DIR__ . '/init.php';
require_once 'classes/RegistrationForm_class.php';
require_once 'classes/DataBase_class.php';

if(isset($_POST['submit_register'])){
    $param = parse_ini_file("config.ini");
    $obj = DataBase::getDB($param['DB_SERVER'], $param['DB_USERNAME'], $param['DB_PASSWORD'], $param['DB_DATABASE']);
    $form = new RegistrationForm($_POST);

    $form->register($obj);
}

echo $twig->render('register.html');
