<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TagCreator;
use App\Services\TagRemover;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where(['user_id' => Auth::id()])->get();

        return view('tag.index', compact('tags'));
    }

    public function store(Request $request, TagCreator $tagCreator)
    {
        $tag = $tagCreator->createTag($request->tag_name, $request->repo_name);
    }

    public function update(Request $request)
    {
        $tag = Tag::find($request->tag_id);
        $tag->name = $request->tag_name;
        $tag->save();
    }
}
