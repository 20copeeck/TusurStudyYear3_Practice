<?php

class DataBase
{
    public static $Connect;	// Хранит результат соединения с базой данных
    public static $Select;	// Хранит результат выбора базы данных

    // Метод создает соединение с базой данных
    public static function ConnectDB($host, $user, $password, $database)
    {
        // Пробуем создать соединение с базой данных
        self::$Connect = mysqli_connect($host, $user, $password);

        // Если подключение не прошло, вывести сообщение об ошибке..
        if(!self::$Connect)
        {
            echo "<p><b>Не удалось подключиться к серверу MySQL</b></p>";
            exit();
            return false;
        }

        // Пробуем выбрать базу данных
        self::$Select = mysqli_select_db(self::$Connect, $database);

        // Если база данных не выбрана, вывести сообщение об ошибке..
        if(!self::$Select)
        {
            echo "<p><b>".mysqli_error()."</b></p>";
            exit();
            return false;
        }

        // Возвращаем результат
        return self::$Connect;
    }

    // Метод закрывает соединение с базой данных
    public static function Close()
    {
        // Возвращает результат
        return mysqli_close(self::$Connect);
    }
}
?>