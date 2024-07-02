<?php

namespace App\Interfaces;

interface CobaRepositoryInterface
{

    function get();
    function show($id);
    function update($request, $id);
    function delete($id);
}
