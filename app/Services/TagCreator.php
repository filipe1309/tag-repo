<?php

namespace App\Services;

use App\Models\{ Tag, TagRepository, Repository };
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagCreator
{
    public function createTag(string $tagName, string $repoName): Tag
    {
        DB::beginTransaction();
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $repo = $this->createRepo($tag, $repoName);
        $this->relateTagRepo($tag, $repo);
        // $this->criarTemporadas($serie, $qtdTemporadas, $epPorTemporada);
        DB::commit();

        return $tag;
    }

    public function createRepo($tag, $repoName): Repository
    {
        return Repository::firstOrCreate(['name' => $repoName]);
    }

    public function relateTagRepo($tag, $repo): void
    {
        TagRepository::firstOrCreate(['tag_id' => $tag->id, 'repository_id' => $repo->id, 'user_id' => Auth::id(), 'tag_repository_type' => Repository::class]);
    }
}