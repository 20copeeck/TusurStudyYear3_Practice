<?php

$param = parse_ini_file("config.ini");
define('DB_SERVER', $param['DB_SERVER']);
define('DB_USERNAME', $param['DB_USERNAME']);
define('DB_PASSWORD', $param['DB_PASSWORD']);
define('DB_DATABASE', $param['DB_DATABASE']);

require_once 'DataBase_class.php';


class Authentication
{
    private static $_dbConnect;

    private static function ConnectDB()
    {
        self::$_dbConnect = DataBase::ConnectDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public static function Login()
    {
        if(isset($_POST['submit_login'])){
            self::ConnectDB();
            $login = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['login']));
            $password = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['password']));
            if (!empty($login) && !empty($password)) {
                $query = "SELECT * FROM users WHERE login = '$login'";
                $result = mysqli_query(self::$_dbConnect, $query);
                $rows = mysqli_fetch_array($result);

                if ($rows['login'] != $login) {
                    echo "Такого логина не существует";
                    exit();
                } else {
                    if ($rows['password'] == $password) {
                        echo "Вы вошли как $login";
                    } else {
                        echo "Неверный пароль";
                    }
                }
            }
            DataBase::Close();
        }
    }

    public static function Register()
    {
        if(isset($_POST['submit_register'])){
            self::ConnectDB();

            $name = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['name']));
            $surname = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['surname']));
            $email = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['email']));
            #Проверяем формат полученного почтового адреса с помощью регулярного выражения
            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
            if (!preg_match($reg_email, $email)) {
                print ("Вы неправильно ввели email<BR>\n");
                exit();
            }
            $phone = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['phone']));
            $login = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['login']));
            $password = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['password']));

            if (!empty($name)&&!empty($surname)&&!empty($email)&&!empty($phone)&&!empty($login)&&!empty($password)){
                $query = "SELECT * FROM users WHERE login = '$login'";
                $result = mysqli_query(self::$_dbConnect, $query);
                if (mysqli_num_rows($result) == 0){
                    $query = "INSERT into users (name, surname, email, phone, login, password) values ('$name', '$surname', '$email',  '$phone', '$login', '$password')";
                    if (mysqli_query(self::$_dbConnect, $query)) {
                        print ("Вы успешно зарегистрированы<BR>\n");
                    } else {
                        print ("Ошибка! Регистрация не выполнена<BR>\n" . mysqli_error(self::$_dbConnect));
                    }
                }else{
                    echo "Логин уже существует";
                }
            }
            DataBase::Close();
        }
    }
}
?>