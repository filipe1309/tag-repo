@extends('master')

@section('title', 'Homepage')

@section('content')

    <form action="/" method="post">
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
                <span class="d-flex">
                    <strong>{{ $repo->full_name }}</strong>
                    <div id="tag-container-{{ $repo->id }}"></div>
                </span>
                <span class="d-flex">
                    <div class="input-group mr-1" hidden id="repo-{{ $repo->id }}">
                        <input type="text" class="form-control" id="repo-input-{{ $repo->id }}" value="" placeholder="Tag name">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="addTagToRepo({{ $repo->id }}, '{{ $repo->full_name }}')">
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                    </div>
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $repo->id }})">
                        <i class="fas fa-tags"></i>
                    </button>
                </span>
            </li>
            
        @endforeach
        </ul>
    @endif
    
    <script>
        function toggleInput(repoId) {
            const repoEl = document.getElementById(`repo-${repoId}`);
            if (repoEl.hasAttribute('hidden')) {
                repoEl.removeAttribute('hidden');
            } else {
                repoEl.hidden = true;
            }
        }

        function addTagToRepo(repoId, repoName) {
            const tagContainerEl = document.getElementById(`tag-container-${repoId}`);
            const repoInputEl = document.getElementById(`repo-input-${repoId}`);
            let exists = false;

            tagContainerEl.querySelectorAll('span').forEach((tag) => {
                if (tag.textContent == repoInputEl.value) exists = true;
            });

            if (!exists && repoInputEl.value) {
                tagContainerEl.innerHTML += `<span class="badge badge-pill badge-primary ml-2">${repoInputEl.value}</span>`;
            }
            repoInputEl.value = '';
        }
    </script>
@endsection

