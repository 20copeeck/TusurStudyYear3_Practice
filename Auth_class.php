<?php

/**
 * @see DataBase_class
 */
require_once 'DataBase_class.php';

/**
 * Register user and log in user
 *
 * Class Authentication
 */
class Authentication
{
    /**
     * Logging in user
     */
    public function login(){
        if(isset($_POST['submit_login'])){
            $db = DataBase::getDB();
            $login = $db->encoding(trim($_POST['login']));
            $password = $db->encoding(trim($_POST['password']));

            if (!empty($login) && !empty($password)) {
                $query = "SELECT * FROM users WHERE login = '$login'";
                $result = $db->query('SELECT', $query);

                if ($result['login'] != $login) {
                    echo "Такого логина не существует";
                } else {
                    if ($result['password'] == $password) {
                        echo "Вы вошли как $login";
                    } else {
                        echo "Неверный пароль";
                    }
                }
            }
        }
    }

    /**
     * User registration
     */
    public function register()
    {
        if(isset($_POST['submit_register'])){
            $db = DataBase::getDB();
            $name = $db->encoding(trim($_POST['name']));
            $surname = $db->encoding(trim($_POST['surname']));
            $email = $db->encoding(trim($_POST['email']));
            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
            if (!preg_match($reg_email, $email)) {
                print ("Вы неправильно ввели email");
            }
            $phone = $db->encoding(trim($_POST['phone']));
            $login = $db->encoding(trim($_POST['login']));
            $password = $db->encoding(trim($_POST['password']));

            if (!empty($name)&&!empty($surname)&&!empty($email)&&!empty($phone)&&!empty($login)&&!empty($password)){
                $query = "SELECT * FROM users WHERE login = '$login'";
                $result = $db->query('SELECT',$query);

                if (empty($result['id'])){
                    $query = "INSERT into users (name, surname, email, phone, login, password) values ('$name', '$surname', '$email',  '$phone', '$login', '$password')";
                    if ($db->query('INSERT',$query)) {
                        print ("Вы успешно зарегистрированы как $login");
                    } else {
                        print ("Ошибка! Регистрация не выполнена");
                    }
                }else{
                    echo "Логин уже существует";
                }
            }
        }
    }
}
?>