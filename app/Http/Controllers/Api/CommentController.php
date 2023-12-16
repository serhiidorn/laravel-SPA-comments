<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\GetCommentsAction;
use App\Actions\StoreCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetCommentsRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index(GetCommentsRequest $request, GetCommentsAction $action): AnonymousResourceCollection
    {
        $comments = $action->handle($request->query());

        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request, StoreCommentAction $action): Response
    {
        $action->handle($request->validated());

        return response()->noContent();
    }
}
