<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\StoreCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, StoreCommentAction $action): Response
    {
        $action->handle($request->validated());

        return response()->noContent();
    }
}
