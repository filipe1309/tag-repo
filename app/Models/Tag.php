<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function repositories()
    {
        return $this->morphedByMany('App\Models\Repository', 'tag_repository');
    }
}
