<?php


namespace App\Http\Services;

use App\Http\Contracts\PostInterface;
use App\Models\Post;
use App\Models\Website;

class PostService implements PostInterface
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index($websiteId)
    {
        $website = Website::where('id',$websiteId)->first();
        return $website->posts;
    }
    public function create($credentials)
    {
        return $this->post->create($credentials);
    }
}
