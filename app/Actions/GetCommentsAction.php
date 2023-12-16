<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

class GetCommentsAction
{
    public function handle(array $requestQuery)
    {
        return Comment::query()
            ->whereNull('parent_id')
            ->when(data_get($requestQuery, 'sort'), function (Builder $builder, array $column) {
                $builder->orderBy(...$column);
            })
            ->paginate(25);
    }
}
