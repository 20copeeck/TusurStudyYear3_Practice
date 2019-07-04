<?php
require_once 'DataBase_class.php';

class RegistrationForm{

    private $name;
    private $surname;
    private $email;
    private $phone;
    private $login;
    private $password;

    public function __construct(Array $data)
    {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->surname = isset($data['surname']) ? $data['surname'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
        $this->login = isset($data['login']) ? $data['login'] : null;
        $this->password = isset($data['password']) ? $data['password'] : null;
    }

    public function validate(){
        return !empty($this->name) && !empty($this->surname) && !empty($this->email) && !empty($this->phone) && !empty($this->login) && !empty($this->password);
    }

    public function checkLogin(){
        $db = DataBase::getDB();
        $query = "SELECT * FROM users WHERE login = '$this->login'";
        $result = $db->query('SELECT', $query);
        return empty($result['id']);
    }

    public function insertDB()
    {
        $db = DataBase::getDB();
        $query = "INSERT into users (name, surname, email, phone, login, password) values ('$this->name', '$this->surname', '$this->email',  '$this->phone', '$this->login', '$this->password')";
        return $db->query('INSERT', $query);
    }
}
?>