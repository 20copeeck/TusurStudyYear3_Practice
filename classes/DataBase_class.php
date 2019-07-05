<?php

/**
 * @see interface IData
 */
require dirname(__DIR__).'\interface.php';

/**
 * Class DataBase
 *
 * Class for user login and registration via database
 */
class DataBase implements IData
{
    /**
     * Single instance class
     *
     * @var null
     */
    private static $db = null;
    /**
     * Database connection
     *
     * @var mysqli
     */
    private $mysqli;

    /**
     * DataBase constructor
     *
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     */
    private function __construct($host, $username, $password, $database)
    {
        $this->mysqli = new mysqli($host, $username, $password, $database);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /**
     * Getting an instance of a class. If it already exists,
     * it returns; if it does not exist, it is created and returned
     *
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     * @return DataBase|null
     */
    public static function getDB($host, $username, $password, $database)
    {
        if (self::$db == null) {
            self::$db = new DataBase($host, $username, $password, $database);
        }
        return self::$db;
    }

    /**
     * Data output from the database
     *
     * @param $login
     * @return array|null
     */
    public function derive($login){
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($this->mysqli, $query);
        return mysqli_fetch_array($result);
    }

    /**
     * Entering data into the database
     *
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $login
     * @param $password
     * @return bool|mysqli_result
     */
    public function insert($name, $surname, $email, $phone, $login, $password){
        $query = "INSERT into users (name, surname, email, phone, login, password) values ('$name', '$surname', '$email', '$phone', '$login', '$password')";
        return mysqli_query($this->mysqli, $query);
    }

    /**
     * When the object is destroyed,
     * the database connection is closed
     *
     * DataBase destructor
     */
    public function __destruct()
    {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }
}
?>