<?php
require_once '../../models/users.php';
class UsersController
{
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = new Users();
    }

    public function checkUser($email, $username)
    {
        return $this->usersModel->check($email, $username);
    }
}
