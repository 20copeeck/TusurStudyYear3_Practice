<?php

/**
 * Class RegistrationForm
 *
 * Register user account
 */
class RegistrationForm
{
    /**
     * Username
     *
     * @var mixed|null
     */
    private $name;
    /**
     * User surname
     *
     * @var mixed|null
     */
    private $surname;
    /**
     * User's mailing address
     *
     * @var mixed|null
     */
    private $email;
    /**
     * User mobile number
     *
     * @var mixed|null
     */
    private $phone;
    /**
     * User login (nickname)
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
     * RegistrationForm constructor
     *
     * @param array $data
     */
    public function __construct(Array $data)
    {
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->surname = isset($data['surname']) ? $data['surname'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
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
        return !empty($this->name) && !empty($this->surname) && !empty($this->email) && !empty($this->phone) && !empty($this->login) && !empty($this->password);
    }

    /**
     * Account registration function
     *
     * @param IData $obj
     */
    public function register(IData $obj)
    {
        if (!$this->checkVoid()) {
            echo 'Не все поля заполнены';
            return;
        }
        $result = $obj->derive($this->login);
        if($result['id']){
            echo 'Такой логин уже существует';
            return;
        }
        $result = $obj->insert($this->name, $this->surname, $this->email,  $this->phone, $this->login, $this->password);
        if(!$result){
            echo 'Ошибка регистрации';
            return;
        }
        echo "Вы успешно зарегистрированы как $this->login";
    }
}
?>