<?php

/**
 * Class DataBase
 *
 * Creates a connection to the database
 * and allows you to work with it
 */
class DataBase
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
     * Connects to the database, sets the locale
     * and encoding of the connection.
     *
     * DataBase constructor.
     */
    private function __construct() {
        $param = parse_ini_file("config.ini");
        $this->mysqli = new mysqli($param['DB_SERVER'], $param['DB_USERNAME'], $param['DB_PASSWORD'], $param['DB_DATABASE']);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /**
     *Getting an instance of a class. If it already exists,
     * it returns; if it does not exist, it is created and returned.
     *
     * @return DataBase|null
     */
    public static function getDB() {
        if (self::$db == null){
            self::$db = new DataBase();
        }
        return self::$db;
    }

    /**
     * Performs MySQL queries
     *
     * @param $act
     * @param $query
     * @return array|bool|mysqli_result|null
     */
    public function query($act, $query) {
        if($act == 'SELECT'){
            $query = mysqli_query($this->mysqli, $query);
            $result = mysqli_fetch_array($query);
        }else{
            $result = mysqli_query($this->mysqli, $query);
        }
        return $result;
    }

    /**
     * Encodes a string
     *
     * @param $string
     * @return string
     */
    public function encoding($string) {
        return $result = mysqli_real_escape_string($this->mysqli, $string);
    }

    /**
     * When the object is destroyed,
     * the database connection is closed.
     *
     * DataBase destructor.
     */
    public function __destruct() {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }
}
?>