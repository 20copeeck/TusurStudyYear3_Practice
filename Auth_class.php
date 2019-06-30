<?php

// Параметры соединения с базой данных
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'newdb');

require_once 'DataBase_class.php';

class Auth{

    private static $_dbConnect;

    private static function ConnectDB()
    {
        self::$_dbConnect = DataBase::ConnectDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public static function Login()
    {
        self::ConnectDB();

        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            if ($login == '') {
                unset($login);
            }
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            if ($password =='') {
                unset($password);
            }
        }
        if (empty($login) or empty($password)){
            exit ("Заполните все поля!");
        }

        $login = trim($login);
        $password = trim($password);
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query(self::$_dbConnect, $query);
        $rows = mysqli_fetch_array($result);

        if ($rows['login'] != $login)
        {
            echo "Введенный логин не найден";
        }
        else
        {
            if($rows['password'] == $password)
            {
                echo "Здравствуй $login";
            }
            else
            {
                echo "Пароль введен неверно";
            }
        }


        /*if (empty($rows['password'])){
            exit ("Извините, введённый вами email или пароль неверный.");
        }
        else {
            if ($rows['password']==$password) {
                echo "Вы успешно вошли на сайт! <a href='index.php'>Главная страница</a>";
            }
            else {
                exit ("Извините, введённый вами email или пароль неверный.");
            }
        }*/

        DataBase::Close();
    }
}
?>