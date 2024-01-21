<?php

namespace App\Actions;

use App\Events\CommentCreated;
use App\Jobs\CommentImageResizeJob;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class StoreCommentAction
{
    public function handle(array $data): Comment
    {
        if (data_get($data, 'image')) {
            $imagePath = Storage::putFile('images', $data['image']);

            data_set($data, 'image', $imagePath);

            $fullImagePath = Storage::path($imagePath);
            $image = ImageManagerStatic::make($fullImagePath);

            if ($image->width() > 320 || $image->height() > 240) {
                CommentImageResizeJob::dispatch($fullImagePath);
            }
        }

        if (data_get($data, 'file')) {
            $filePath = Storage::putFile('files', $data['file']);

            data_set($data, 'file', $filePath);
        }

        $comment = Comment::create($data);

        Cache::store('redis')->tags('comments')->flush();

        CommentCreated::dispatch($comment);

        return $comment;
    }
}
