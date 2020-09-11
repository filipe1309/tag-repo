<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $results = null;
        $page = $request->page = !empty($request->page) ? $request->page : 1;
        if ($request->q) {
            $githubClient = new \App\Api\GithubApiClient();
            $results = $githubClient->get("search/repositories?q={$request->q}&per_page=10&sort={$request->sort}&order={$request->order}&page={$request->page}");
        }
        $searchParam = $request->all();
        if (empty($searchParam['page'])) $searchParam['page'] = 1;
        
        return view('home', compact('results', 'page', 'searchParam'));
    }
}
