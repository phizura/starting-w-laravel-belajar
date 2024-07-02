<?php

namespace App\Interfaces;

interface PostInterface
{

    public function getAll();
    public function getAllPostUser();
    public function getOneByslug($slug);

    public function create($data);
    public function update($slug,  $data );
    public function delete($slug);
}
