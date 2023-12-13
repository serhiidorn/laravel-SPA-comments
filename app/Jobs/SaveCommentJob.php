<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManagerStatic;

class SaveCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private array $attributes)
    {
    }

    public function handle(): void
    {
        if (data_get($this->attributes, 'image')) {
            $imagePath = Storage::path($this->attributes['image']);

            $image = ImageManagerStatic::make($imagePath);

            if ($image->width() > 320 || $image->height() > 240) {
                $image->resize(320, 240, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                })->save($image->basePath());
            }
        }

        Comment::create($this->attributes);
    }
}
