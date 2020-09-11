@extends('master')

@section('title', 'Homepage')

@section('content')
    @csrf

    @if(!empty($tags))
        <h1>
            Tags 
            <a href="#" id="new-tag" onclick="toggleNewTagInput()" class="btn-new-tag text-success">
                <i class="fas fa-plus-circle"></i>
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div hidden class="input-group mr-1" id="tag-new">
                    <input type="text" class="form-control" id="tag-input-new" value="" placeholder="Tag name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="addTag()">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
            </div>
        </h1>
        
        <ul class="list-group">
        @foreach($tags as $tag)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="d-flex">
                    <h3><span class="badge badge-pill badge-primary ml-2 tag-badge" id="tag-badge-{{ $tag->id }}">{{ $tag->name }}</span></h3>
                    <div class="input-group mr-1" hidden id="tag-{{ $tag->id }}">
                        <input type="text" class="form-control" id="tag-input-{{ $tag->id }}" value="" placeholder="Tag name">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="addTag({{ $tag->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                    </div>
                </span>
                <span class="d-flex">
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $tag->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="/tag/{{ $tag->id }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($tag->name) }}?')">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </span>
            </li>
        @endforeach
        </ul>
    @endif
    
    <script>
        function toggleNewTagInput() {
            const tagNewInputEl = document.getElementById(`tag-new`);
            if (tagNewInputEl.hasAttribute('hidden')) {
                tagNewInputEl.removeAttribute('hidden');
            } else {
                tagNewInputEl.hidden = true;
            }
        }

        function toggleInput(tagId) {
            const tagEl = document.getElementById(`tag-${tagId}`);
            const tagInputEl = document.getElementById(`tag-input-${tagId}`);
            const tagBadgeEl = document.getElementById(`tag-badge-${tagId}`);
            if (tagEl.hasAttribute('hidden')) {
                tagEl.removeAttribute('hidden');
                tagBadgeEl.hidden = true;
                tagInputEl.value = tagBadgeEl.textContent;
            } else {
                tagBadgeEl.removeAttribute('hidden');
                tagEl.hidden = true;
            }
        }

        function addTag(tagId) {
            const allTagsBadgeEl = document.querySelectorAll(`.tag-badge`);
            const tagBadgeEl = document.getElementById(`tag-badge-${tagId}`);
            let tagInputEl = document.getElementById(`tag-input-${tagId}`);
            if (!tagId) {
                tagInputEl = document.getElementById('tag-input-new');
            }
            let exists = false;
            console.log(tagInputEl);
            allTagsBadgeEl.forEach((tag) => {
                if (tag.textContent == tagInputEl.value && tag.id !== tagId) exists = true;
            });

            if (!exists && tagInputEl.value) {
                console.log('new tag');
                if (tagId) {
                    tagBadgeEl.textContent = tagInputEl.value;
                    updateTag(tagInputEl.value, tagId);
                } else {
                    createTag(tagInputEl.value, tagId);
                }
            } else {
                alert('Tag already exists');
            }
        }

        function createTag(tagName) {
            let formData = new FormData();
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('tag_name', tagName);
            formData.append('_token', token);
            
            const url = '/tag/store';
            fetch(url, {
                body: formData,
                method: 'POST',
            })
            .then(() => {
                toggleNewTagInput();
                document.location.reload(true);
            });
        }

        function updateTag(tagName, tagId) {
            let formData = new FormData();
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('tag_id', tagId);
            formData.append('tag_name', tagName);
            formData.append('_token', token);
            
            const url = '/tag/update';
            fetch(url, {
                body: formData,
                method: 'POST',
            })
            .then(() => {
                toggleInput(tagId);
            });
        }
    </script>
@endsection

