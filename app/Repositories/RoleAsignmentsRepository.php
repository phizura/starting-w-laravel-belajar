<?php

namespace App\Repositories;

use App\Interfaces\RoleAsignmentsInterface;
use App\Models\RoleAssignment;

class RoleAsignmentsRepository implements RoleAsignmentsInterface
{

    private $model;

    public function __construct(RoleAssignment $model)
    {
        $this->model = $model;
    }

    public function getAllHistory()
    {
        return $this->model->with('user', 'changer')->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
    }

    public function update($request, $id)
    {
    }

    public function delete($id)
    {
    }
}
