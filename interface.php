<?php

Interface IData
{
    public function insert($name, $surname, $email, $phone, $login, $password);

    public function derive($login);
}
?>