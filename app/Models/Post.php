<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'website_posts';
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'website_id'
    ];
}
