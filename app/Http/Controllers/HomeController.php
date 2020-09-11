<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $results = null;
        if ($request->q) {
            $githubClient = new \App\Api\GithubApiClient();
            $results = $githubClient->get("search/repositories?q={$request->q}&per_page=10&sort={$request->sort}&order={$request->order}");
        }
        
        return view('home', compact('results'));
    }
}
