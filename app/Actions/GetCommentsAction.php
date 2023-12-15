<?php

declare(strict_types=1);

namespace App\Actions;


use App\Models\Comment;

class GetCommentsAction
{
    public function handle()
    {
        return Comment::query()
            ->whereNull('parent_id')
            ->latest()
            ->paginate(25);
    }
}
