<?php

/**
 * Class DataBase
 *
 * Create and delete connection to MySQL database
 * @return object
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
     * Connects to the database, sets the locale
     * and encoding of the connection.
     *
     * DataBase constructor.
     */
    private function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "newdb");
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
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