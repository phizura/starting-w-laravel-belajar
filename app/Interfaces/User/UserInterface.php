<?php

namespace App\Interfaces\User;

interface UserInterface
{
    public function getAll();
    public function getById($id);
    public function getByRole($role);
    public function getByUsername($username);

    public function update($id, $data);
}
