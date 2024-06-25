<?php

namespace App\Interfaces;

interface RoleAsignmentsInterface
{

    public function getAllHistory();

    public function create($data);
    public  function show($id);
    public function update($request, $id);
    public  function delete($id);
}
