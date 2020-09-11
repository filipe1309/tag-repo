@extends('master')

@section('title', 'Repos')

@section('content')

    @csrf

    <h1>Repositories</h1>
        
    <ul class="list-group">
    @foreach($repos as $repo)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="d-flex">
                <strong>{{ $repo->name }}</strong>
                <div id="tag-container-{{ $repo->id }}">
                <?php
                    $tags = $repo->tagsByLogggedUser();
                    foreach($tags as $tag) {
                        echo '<span class="badge badge-pill badge-primary ml-2">'.$tag->name.'</span>';
                    }
                ?>
                </div>
            </span>
        </li>
    @endforeach
    </ul>
    
@endsection

