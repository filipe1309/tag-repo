<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'tag_repository');
    }
}
