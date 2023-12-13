<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\SaveCommentJob;
use Illuminate\Support\Facades\Storage;

class StoreCommentAction
{
    public function handle(array $data): void
    {
        if (data_get($data, 'image')) {
            $imagePath = Storage::putFile('images', $data['image']);

            data_set($data, 'image', $imagePath);
        }

        if (data_get($data, 'file')) {
            $filePath = Storage::putFile('files', $data['file']);

            data_set($data, 'file', $filePath);
        }

        SaveCommentJob::dispatch($data);
    }
}
