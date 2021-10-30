<?php

namespace App\Http\Contracts;

interface SubscriptionInterface{
    public function index($id);
    public function create($credentials);
}
