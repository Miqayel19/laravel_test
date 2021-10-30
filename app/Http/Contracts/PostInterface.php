<?php

namespace App\Http\Contracts;

interface PostInterface{
    public function index($id);
    public function create($credentials);
}
