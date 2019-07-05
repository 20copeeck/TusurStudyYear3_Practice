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
     * Result of query
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
    private function checkVoid()
    {
        return !empty($this->login) && !empty($this->password);
    }

    /**
     * Login feature
     *
     * @param IData $obj
     */
    public function login(IData $obj)
    {
        if (!$this->checkVoid()) {
            echo 'Не все поля заполнены';
            return;
        }
        if (!$this->result = $obj->derive($this->login)) {
            echo 'Такого логина не существует';
            return;
        }
        if ($this->result['password'] != $this->password) {
            echo 'Неверный пароль';
            return;
        }
        echo "Вы успешно вошли в аккаунт как $this->login";
    }
}
?>