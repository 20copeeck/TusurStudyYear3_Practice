<?php

/**
 * @see DataBase_class
 */
require_once 'DataBase_class.php';

/**
 * Class LoginForm
 *
 * User login to account
 */
class LoginForm
{
    /**
     * Username
     *
     * @var mixed|null
     */
    private $login;
    /**
     * User password
     *
     * @var mixed|null
     */
    private $password;
    /**
     * Result of query to database
     *
     * @var mixed|null
     */
    private $result;

    /**
     * LoginForm constructor
     *
     * @param array $data
     */
    public function __construct(Array $data)
    {
        $this->login = isset($data['login']) ? $data['login'] : null;
        $this->password = isset($data['password']) ? $data['password'] : null;
    }

    /**
     * Check for void fields
     *
     * @return bool
     */
    public function checkVoid()
    {
        return !empty($this->login) && !empty($this->password);
    }

    /**
     * Verify login with database
     *
     * @return bool
     */
    public function checkLogin()
    {
        $db = DataBase::getDB();
        $query = "SELECT * FROM users WHERE login = '$this->login'";
        $this->result = $db->select($query);
        return $this->result['login'] == $this->login;
    }

    /**
     * Verify password with database
     *
     * @return bool
     */
    public function checkPassword()
    {
        return $this->result['password'] == $this->password;
    }
}
?>