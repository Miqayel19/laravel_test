<?php


namespace App\Http\Services;

use App\Http\Contracts\SubscriptionInterface;
use App\Models\User;

class SubscriptionService implements SubscriptionInterface
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index($userId)
    {
        $user = User::where('id',$userId)->first();
        return $user->subscriptions;
    }

    public function create($credentials)
    {
        $user = User::where('id',$credentials['user_id'])->first();
        return $user->websites()->attach($credentials['website_id']);
    }
}
