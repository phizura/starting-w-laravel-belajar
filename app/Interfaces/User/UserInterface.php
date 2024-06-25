<?php

namespace App\Interfaces\User;

interface UserInterface
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUsersByRole($role);
    public function getUserByUsername($username);

    public function updateUserById($id, $data);
}
