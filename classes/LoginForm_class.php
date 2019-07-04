<?php

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
     * DataBase class object
     *
     * @var
     */
    private $db;

    /**
     * LoginForm constructor
     *
     * @param array $data
     */
    public function __construct(Array $data, $db)
    {
        $this->login = isset($data['login']) ? $data['login'] : null;
        $this->password = isset($data['password']) ? $data['password'] : null;
        $this->db = $db;
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
        $query = "SELECT * FROM users WHERE login = '$this->login'";
        $this->result = $this->db->select($query);
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