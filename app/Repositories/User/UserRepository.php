<?php

namespace App\Repositories\User;

use App\Interfaces\User\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUsersByRole($role)
    {
        return $this->user->where("is_admin", $role)->get();
    }

    public function getUsersByUsername($username)
    {
        return $this->user->firstWhere('username', $username);
    }

    public function updateUserById($id, $data)
    {
        $this->user->where('id', $id)
        ->update($data);
    }
}
