<?php

namespace App\Interfaces;

interface PostInterface
{

    public function getAll();
    public function getAllPostUser();
    public function getOneByslug($slug);

    public function create(array $data);
    public function update($slug, array $data );
    public function delete($slug);
}
