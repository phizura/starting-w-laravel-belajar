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

    public function getAll()
    {
        return $this->user->all();
    }

    public function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function getByRole($role)
    {
        return $this->user->where("is_admin", $role)->get();
    }

    public function getByUsername($username)
    {
        return $this->user->firstWhere('username', $username);
    }

    public function update($id, $data)
    {
        $this->user->where('id', $id)
        ->update($data);
    }
}
