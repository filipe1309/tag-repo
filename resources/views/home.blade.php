@extends('master')

@section('title', 'Homepage')

@section('content')

    

    <form action="/search" method="post">
        <label for="nome">Search repositories on GitHub:</label>
        <input type="text" class="form-control" name="q" id="Repo">
        @csrf
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>
    
    <br>
    
    @if(isset($results))
        <h1>Results</h1>
        
        <ul class="list-group">
        @foreach($results->items as $repo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>{{ $repo->full_name }}</strong>
            </li>
        @endforeach
        </ul>
    @endif
    
@endsection

