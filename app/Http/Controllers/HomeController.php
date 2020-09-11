<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        // $messages = Message::all();
        $githubClient = new \App\Api\GithubApiClient();
        $results = $githubClient->get("search/repositories?q={$request->q}&per_page=10");
        
        return view('home', compact('results'));
    }
}
