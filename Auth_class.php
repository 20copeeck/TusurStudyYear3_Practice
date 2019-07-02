<?php
/**
 * Stores an array of configuration file
 *
 * @var array
 */
$param = parse_ini_file("config.ini");
/**
 * Constant hostname
 */
define('DB_SERVER', $param['DB_SERVER']);
/**
 * Constant username MySQL
 */
define('DB_USERNAME', $param['DB_USERNAME']);
/**
 * Constant user password MySQL
 */
define('DB_PASSWORD', $param['DB_PASSWORD']);
/**
 * Constant database name
 */
define('DB_DATABASE', $param['DB_DATABASE']);

/**
 * @see DataBase_class
 */
require_once 'DataBase_class.php';

/**
 * Class Authentication
 *
 * With the help of MySQL queries it registers
 * the user and logs in to the account.
 * @return void
 */
class Authentication
{
    /**
     * Stores the result of the database connection
     *
     * @var object|bool
     */
    private static $_dbConnect;

    /**
     * Creates a database connection
     *
     * @uses DataBase::ConnectDB
     * @return void
     */
    private static function ConnectDB()
    {
        self::$_dbConnect = DataBase::ConnectDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    /**
     * Allows the user to log in
     *
     * @return void
     */
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

    /**
     * Allows the user to register
     *
     * @return void
     */
    public static function Register()
    {
        if(isset($_POST['submit_register'])){
            self::ConnectDB();

            $name = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['name']));
            $surname = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['surname']));
            $email = mysqli_real_escape_string(self::$_dbConnect, trim($_POST['email']));
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