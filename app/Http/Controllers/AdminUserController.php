<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleAsignmentsInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    private $userinterface;
    private $historyrole;

    public function __construct(UserInterface $usernterface, RoleAsignmentsInterface $roleasignmentinterface)
    {
        $this->userinterface = $usernterface;
        $this->historyrole = $roleasignmentinterface;
    }

    public function index()
    {
        return view("dashboard.user.index", [
            "admins" => $this->userinterface->getUsersByRole(1),
            "members" => $this->userinterface->getUsersByRole(0),
            "histories" => $this->historyrole->getAllHistory()
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userinterface->getUserById($id);

        $collection = collect([
            'user_id' => $user->id,
            'changed_by' => auth()->user()->id,
        ]);

        if ($request->type === 'promote') {

            $status = ['is_admin' => 1];
            $log = $collection->merge([
                'old_role' => 'Member',
                'new_role' => 'Admin',
                'change_type' => 'PROMOTE'
            ]);
            $success = $user->username . 'has been promoted to admin';
            $error = $user->username . 'Failed promote to admin';
        } else {

            $status = ['is_admin' => 0];
            $log = $collection->merge([
                'old_role' => 'Admin',
                'new_role' => 'Member',
                'change_type' => 'DEMOTE'
            ]);
            $success = $user->username . 'has been demoted to admin';
            $error = $user->username . 'Failed demote to admin';
        }

        DB::beginTransaction();
        try {

            $this->historyrole->create($log->all());
            $this->userinterface->updateUserById($user->id, $status);
            DB::commit();

            return redirect()->back()->with('success', $success);
        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error', $error . ":" . $err->getMessage());
        }
    }
}
