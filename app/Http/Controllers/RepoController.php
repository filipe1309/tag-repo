<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{ TagRepository, Repository };

class RepoController extends Controller
{
    public function index()
    {
        // $tagRepos = TagRepository::where(['user_id' => Auth::id()])->get();
        $tagRepos = TagRepository::where(['user_id' => \Illuminate\Support\Facades\Auth::id()])->get(); 
        // $tagRepos = Repository::find(1);//where(['user_id' => Auth::id()])->get();
        $repos = [];
        $tagRepos->each(function($tagRepo) use (&$repos) {
            $repo = Repository::find($tagRepo->repository_id);
            $repos[$tagRepo->repository_id] = $repo;
        });

        return view('repo.index', compact('repos'));
    }
}
