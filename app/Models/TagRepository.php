<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends Model
{
    use HasFactory;

    public $fillable = ['tag_id', 'repository_id', 'user_id', 'tag_repository_type'];

}
