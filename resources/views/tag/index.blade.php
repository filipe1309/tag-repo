@extends('master')

@section('title', 'Homepage')

@section('content')
    @csrf

    @if(!empty($tags))
        <h1>Tags</h1>
        
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
            const tagInputEl = document.getElementById(`tag-input-${tagId}`);
            let exists = false;

            allTagsBadgeEl.forEach((tag) => {
                if (tag.textContent == tagInputEl.value && tag.id !== tagId) exists = true;
            });

            if (!exists && tagInputEl.value) {
                console.log('new tag');
                tagBadgeEl.textContent = tagInputEl.value;
                updateTag(tagId, tagInputEl.value);
            }
            // toggleInput(tagId); 
            // tagInputEl.value = '';
        }

        function updateTag(tagId, tagName) {
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

