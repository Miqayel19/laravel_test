<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Resources\FailedResource;
use App\Http\Resources\SubscriptionResource;
use App\Http\Contracts\SubscriptionInterface;


class SubscriptionController extends Controller
{
        protected $subscriptionService;

        public function __construct(SubscriptionInterface $subscriptionService)
        {
            $this->subscriptionService = $subscriptionService;
        }


        /**
        * POST /subscribe
        * Create Subscription
        *
        * @param SubscriptionRequest $request
        * @return FailedResource|SubscriptionResource
        */
       public function subscribe(Request $request)
       {
            $email = $request->email;
            $user = User::where('email',$email)->first();
            if($user){
                $subscription = $user->websites()->where('websites.id', $request->website_id)->exists();
                if($subscription){
                    return new FailedResource((object)['error' => 'Subscription already exists']);
                }else {
                    $credentials = [
                        'user_id' => $user['id'],
                        'website_id' => $request->website_id,
                    ];

                   $newSubscription = $this->subscriptionService->create($credentials);

                   if ($newSubscription) {
                        $subscriptions = $this->subscriptionService->index($user['id']);
                        return new SubscriptionResource((object)['data' => $subscriptions,'message' =>'Successfully added']);
                   }
                   else {
                        return new FailedResource((object)['error' => 'Subscription can not be added']);
                   }
                }
            }
            else {
                return new FailedResource((object)['error' => 'User with that email not found']);
           }

       }
}
