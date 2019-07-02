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
     * Stores the result of the database connection
     *
     * @var object|bool
     */
    private static $Connect;
    /**
     * Stores the result of selecting a database
     *
     * @var bool
     */
    private static $Select;

    /**
     * Creates a database connection
     *
     * @param string $host Hostname
     * @param string $user Username MySQL
     * @param string $password User password MySQL
     * @param string $database Database name
     * @return bool|false|mysqli|Stores
     */
    public static function ConnectDB($host, $user, $password, $database)
    {
        self::$Connect = mysqli_connect($host, $user, $password);
        if(!self::$Connect)
        {
            echo "<p><b>Не удалось подключиться к серверу MySQL</b></p>";
            exit();
            return false;
        }

        self::$Select = mysqli_select_db(self::$Connect, $database);
        if(!self::$Select)
        {
            echo "<p><b>".mysqli_error()."</b></p>";
            exit();
            return false;
        }

        return self::$Connect;
    }

    /**
     *Closes the database connection
     *
     * @return bool
     */
    public static function Close()
    {
        return mysqli_close(self::$Connect);
    }
}
?>