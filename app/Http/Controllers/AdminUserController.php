<?php

namespace App\Http\Controllers;

use App\Interfaces\User\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    private $UserInterface;

    public function __construct(UserInterface $usernterface)
    {
        $this->UserInterface = $usernterface;
    }

    public function index()
    {
        // return $this->UserInterface->getUsersByRole(1);
        return view("dashboard.user.index", [
            "admins" => $this->UserInterface->getUsersByRole(1),
            "members" => $this->UserInterface->getUsersByRole(0),
        ]);
    }

    public function update(Request $request, User $user)
    {

        $data = [];
        if ($request->type === 'promote') {
            $data['is_admin'] = 1;
            $success = $user->username . 'has been promoted to admin';
            $error = $user->username . 'Failed promote to admin';
        } else {

            $data['is_admin'] = 0;
            $success = $user->username . 'has been demoted to admin';
            $error = $user->username . 'Failed demote to admin';
        }

        try {

            $this->UserInterface->updateUserById($user->id, $data);
            return redirect()->back()->with('success', $success);
        } catch (\Throwable $err) {

            return redirect()->back()->with('error', $error . ":" . $err);
        }
    }
}
