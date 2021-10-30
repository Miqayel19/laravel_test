<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User','subscriptions');
    }
    public function posts(){
        return $this->hasMany('App\Models\Post','website_id');
    }
}
