<?php

namespace App\Actions;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class GetCommentsAction
{
    public function handle(array $requestQuery)
    {
        $cacheKey = $this->getCacheKey($requestQuery);

        return Cache::tags('comments')->remember(
            $cacheKey,
            now()->addHour(),
            function () use ($requestQuery) {
                return Comment::query()
                    ->whereNull('parent_id')
                    ->orderBy(...$requestQuery['sort'])
                    ->paginate(25);
            });
    }

    private function getCacheKey(array $requestQuery): string
    {
        $pagePart = data_get($requestQuery, 'page', 1);
        [$sortPart, $orderPart] = data_get($requestQuery, 'sort');

        return 'comments:page='.$pagePart.'&sort='.$sortPart.'&order='.$orderPart;
    }
}
