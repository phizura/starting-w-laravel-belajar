<?php

namespace App\Services;

use App\Interfaces\RoleAsignmentsInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $userInterface;
    private $historyRole;

    public function __construct(UserInterface $userInterface, RoleAsignmentsInterface $roleAssignment)
    {
        $this->userInterface = $userInterface;
        $this->historyRole = $roleAssignment;
    }

    public function getUser($request)
    {
        switch ($request['key']) {
            case 'role':
                return $this->userInterface->getByRole($request['data']);
                break;
            case 'id':
                return $this->userInterface->getById($request['data']);
                break;
            case 'username':
                return $this->userInterface->getByUsername($request['data']);
                break;
            case 'logChange':
                return $this->historyRole->getAllHistory();
                break;
            default:
                return $this->userInterface->getAll();
        };
    }

    public function update($id, $request)
    {
        $user = $this->userInterface->getById($id);

        $collection = collect([
            'user_id' => $user->id,
            'changed_by' => auth()->user()->id,
        ]);

        if ($request->type === 'promote') {

            $role = ['is_admin' => 1];
            $log = $collection->merge([
                'old_role' => 'Member',
                'new_role' => 'Admin',
                'change_type' => 'PROMOTE'
            ]);
            $success = $user->username . 'has been promoted to admin';
        } else {

            $role = ['is_admin' => 0];
            $log = $collection->merge([
                'old_role' => 'Admin',
                'new_role' => 'Member',
                'change_type' => 'DEMOTE'
            ]);
            $success = $user->username . 'has been demoted to admin';
        }

        DB::beginTransaction();
        try {

            $this->historyRole->create($log->all());
            $this->userInterface->update($user->id, $role);

            DB::commit();
            return [
                'respon' => 'success',
                'message' => $success
            ];
        } catch (\Throwable $th) {

            DB::rollBack();
            return [
                'respon' => 'error',
                'Message' => $th->getMessage()
            ];
        }
    }
}
