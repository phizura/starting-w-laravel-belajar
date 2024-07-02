<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;


class AdminUserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view("dashboard.user.index", [
            "admins" => $this->userService->getUser([
                "key" => 'role',
                "data" => 1,
            ]),
            "members" => $this->userService->getUser([
                "key" => 'role',
                "data" => 0,
            ]),
            "histories" => $this->userService->getUser([
                "key" => 'logChange',
            ])
        ]);
    }

    public function update(Request $request, $id)
    {

        $res = $this->userService->update($id, $request);

        if ($res['respon'] === 'error') {
            return redirect()->back()->with($res['respon'], $res['message']);
        }

        return redirect()->back()->with($res['respon'], $res['message']);
    }
}
