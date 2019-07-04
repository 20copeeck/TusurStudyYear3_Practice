<?php

require_once __DIR__ . '/init.php';
require_once 'classes/LoginForm_class.php';
require_once 'classes/DataBase_class.php';

$form = new LoginForm($_POST, DataBase::getDB());

if ($_POST) {
    if ($form->checkVoid()) {
        if ($form->checkLogin()) {
            if ($form->checkPassword()) {
                echo 'Вы успешно вошли в аккаунт';
            } else {
                echo 'Неверный пароль';
            }
        } else {
            echo 'Такого логина не существует';
        }
    } else {
        echo 'Не все поля заполнены';
    }
}
echo $twig->render('index.html');