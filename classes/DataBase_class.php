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
     * and encoding of the connection
     *
     * DataBase constructor
     */
    private function __construct()
    {
        $param = parse_ini_file("config.ini");
        $this->mysqli = new mysqli($param['DB_SERVER'], $param['DB_USERNAME'], $param['DB_PASSWORD'], $param['DB_DATABASE']);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /**
     * Getting an instance of a class. If it already exists,
     * it returns; if it does not exist, it is created and returned
     *
     * @return DataBase|null
     */
    public static function getDB()
    {
        if (self::$db == null) {
            self::$db = new DataBase();
        }
        return self::$db;
    }

    /**
     * Executes a mysql query to remove
     * data from the database.
     *
     * @param $query
     * @return array|null
     */
    public function select($query){
        $query = mysqli_query($this->mysqli, $query);
        return mysqli_fetch_array($query);
    }

    /**
     * Executes a mysql query for data expansion
     *
     * @param $query
     * @return bool|mysqli_result
     */
    public function insert($query){
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