@extends('master')

@section('title', 'Homepage')

@section('content')

    Search on GitHub:

    <form action="/search" method="post">
        <input type="text" name="q" placeholder="Repo">
        @csrf
        <button type="submit">Submit</button>
    </form>
    
    <br>
    
    @if(isset($results))
        Recent Messages:
        
        <ul>
        @foreach($results->items as $repo)
            <li>
                <strong>{{ $repo->full_name }}</strong>
            </li>
        @endforeach
        </ul>
    @endif
    
@endsection

