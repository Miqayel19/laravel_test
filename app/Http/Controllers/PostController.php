<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\PostResource;
use App\Http\Contracts\PostInterface;
use App\Jobs\SendInvitationEmail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Events\PostCreated;


class PostController extends Controller
{

        protected $postService;

        public function __construct(PostInterface $postService)
        {
            $this->postService = $postService;
        }

       /**
        * Create Post
        *
        * @param PostRequest $request,$website_id
        * @return FailedResource|PostResource
        */
       public function store(PostRequest $request,$website_id)
       {
           $credentials = [
               'title' => $request->title,
               'description' => $request->description,
               'website_id' => $website_id,
           ];
           $website = Website::where('id',$website_id)->first();
           if($website){
              $post = Post::where('website_id',$website_id)->first();
              if($post){
                   return new FailedResource((object)['error' => 'Post already exists']);
              }
              else {
                    $newPost = $this->postService->create($credentials);
                    if ($newPost) {

                          event(new PostCreated($post,$website->users));
                          $posts = $this->postService->index($website_id);
                          return new PostResource((object)['data' => $posts,'message' =>'Successfully added']);
                    }
                    else {
                         return new FailedResource((object)['error' => 'Post can not be added']);
                    }
              }

           }
           else {
                  return new FailedResource((object)['error' => 'Website not found']);
           }
       }
}
