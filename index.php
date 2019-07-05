<?php

require_once __DIR__ . '/init.php';
require_once 'classes/LoginForm_class.php';
require_once 'classes/DataBase_class.php';

if(isset($_POST['submit_login'])){
    $param = parse_ini_file("config.ini");
    $obj = DataBase::getDB($param['DB_SERVER'], $param['DB_USERNAME'], $param['DB_PASSWORD'], $param['DB_DATABASE']);
    $form = new LoginForm($_POST);

    $form->login($obj);
}

echo $twig->render('index.html');