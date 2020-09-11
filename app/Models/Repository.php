<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function tagsByLogggedUser()
    {
        $tagRepos = TagRepository::where(['repository_id' => $this->id, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->get(); 
        $tags = [];
        $tagRepos->each(function($tagRepo) use (&$tags) {
            $tag = Tag::find($tagRepo->tag_id);
            $tags[$tagRepo->tag_id] = $tag;
        });

        return $tags;
        // return $this->morphToMany('App\Models\Tag', 'tag_repository');
        // return $this->hasManyThrough(
        //     'App\Models\Tag',
        //     'App\Models\TagRepository',
        //     'repository_id', // Foreign key on users table...
        //     'id', // Foreign key on posts table...
        //     'id', // Local key on countries table...
        //     'tag_id' // Local key on users table...
        // );
    }

    public function tagrepositories()
    {
        return $this->hasMany('App\Models\TagRepository');
    }
}
