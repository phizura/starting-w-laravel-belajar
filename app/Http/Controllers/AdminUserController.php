<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view("dashboard.user.index", [
            "admins" => User::where('is_admin', 1)->get(),
            "members" => User::where("is_admin", 0)->get(),
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

            User::where('id', $user->id)
                ->update($data);
            return redirect()->back()->with('success', $success);
        } catch (\Throwable $err) {

            return redirect()->back()->with('error', $error . ":" . $err);
        }
    }
}
