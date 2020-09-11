@extends('master')

@section('title', 'Homepage')

@section('content')
    <style>
    .pagination {
      display: inline-block;
    }
    
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
      border: 1px solid #ddd;
    }
    
    .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>

    @csrf
    <h1>Search</h1>
    <form action="/" method="get">
        <input type="text" class="form-control" name="q" id="Repo" placeholder="Search repositories on GitHub" required>

        <div class="row">
            <div class="col-sm-3">
                Sort by:  
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="sort" id="sort1" value="stars" checked>
                    <label class="form-check-label" for="sort1">
                        Stars
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="sort" id="sort2" value="updated">
                    <label class="form-check-label" for="sort2">
                        Date
                    </label>
                </div>
            </div>
            <div class="col-sm-3">
                Order by:
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="order" id="order2" value="desc" checked>
                    <label class="form-check-label" for="order2">
                        DESC
                    </label>
                </div>  
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="order" id="order1" value="asc">
                    <label class="form-check-label" for="order1">
                        ASC
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </form>
    
    <br>
    <hr>
    <br>

    @if(isset($results))
        <h1>Results {{ $page }}</h1>
        
        <ul class="list-group">
        @foreach($results->items as $repo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="d-flex">
                    <strong>{{ $repo->full_name }}</strong>
                    <div id="tag-container-{{ $repo->id }}">
                    <?php
                        $repoDb = \App\Models\Repository::firstWhere('name', $repo->full_name);
                        if ($repoDb) {
                            $tagRepos = \App\Models\TagRepository::where(['repository_id' => $repoDb->id, 'user_id' => \Illuminate\Support\Facades\Auth::id()])->get(); 
                            if ($tagRepos) {
                                $tagRepos->each(function($tagRepo) {
                                    $tag = \App\Models\Tag::find($tagRepo->tag_id);
                                    echo '<span class="badge badge-pill badge-primary ml-2">'.$tag->name.'</span>';
                                });
                            }
                        }
                    ?>
                    </div>
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
        <div class="pagination">
            <?php $searchParam['page']-- ?>
            <a href="/?<?= http_build_query($searchParam)?>">❮</a>
            <?php $searchParam['page']++;$searchParam['page']++; ?>
            <a href="/?<?= http_build_query($searchParam)?>">❯</a>
        </div>
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
                createTagRepo(repoInputEl.value, repoId, repoName);
            }
            repoInputEl.value = '';
        }

        function createTagRepo(tagName, repoId, repoName) {
            let formData = new FormData();
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('tag_name', tagName);
            formData.append('repo_name', repoName);
            formData.append('_token', token);
            
            const url = '/tag/store';
            fetch(url, {
                body: formData,
                method: 'POST',
            })
            .then(() => {
                toggleInput(repoId);
            });
        }
    </script>
@endsection

