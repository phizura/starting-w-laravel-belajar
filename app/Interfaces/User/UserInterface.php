<?php

namespace App\Interfaces\User;

interface UserInterface
{
    public function getAllUsers();
    public function getUsersByRole($role);
    public function getUsersByUsername($username);

    public function updateUserById($id, $data);
}
