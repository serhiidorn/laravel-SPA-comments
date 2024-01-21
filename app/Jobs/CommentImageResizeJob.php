<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManagerStatic;

class CommentImageResizeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly string $path)
    {
    }

    public function handle(): void
    {
        $image = ImageManagerStatic::make($this->path);

        $image->resize(320, 240, function (Constraint $constraint) {
            $constraint->aspectRatio();
        })->save($image->basePath());
    }
}
