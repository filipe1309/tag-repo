<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TagCreator;

class TagController extends Controller
{
    public function store(Request $request, TagCreator $tagCreator)
    {
        $tag = $tagCreator->createTag($request->tag_name, $request->repo_name);
    }
}
