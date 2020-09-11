<?php

namespace App\Services;

use App\Models\{ Tag, TagRepository };
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagRemover
{
    public function removeTag(int $tagId): string
    {
        DB::beginTransaction();
        TagRepository::where(['tag_id' => $tagId, 'user_id' => Auth::id()])->delete();
        $tag = Tag::destroy($tagId);
        DB::commit();

        return $tagId;
    }
}