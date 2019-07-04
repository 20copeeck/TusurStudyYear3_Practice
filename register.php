<?php

require_once __DIR__.'/init.php';
require_once('RegistrationForm_class.php');

$form = new RegistrationForm($_POST);

if ($_POST) {
    if ($form->validate()) {
        if($form->checkLogin()){
            if($form->insertDB()){
                echo 'Вы успешно зарегистрированы';
            }else{
                echo 'Ошибка регистрации';
            }
        }else{
            echo 'Такой логин уже существует';
        }
    } else {
        echo 'Не все поля заполнены';
    }
}
echo $twig->render('register.html');
