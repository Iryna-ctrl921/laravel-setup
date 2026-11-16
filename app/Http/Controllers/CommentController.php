<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Task $task): AnonymousResourceCollection
    {
        return CommentResource::collection($task->comments()->paginate(10));
    }

    public function store(StoreCommentRequest $request, Task $task): CommentResource
    {
        $comment = $task->comments()->create($request->validated());
        return new CommentResource($comment);
    }

    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    public function update(Request $request, Comment $comment): CommentResource
    {
        $validated = $request->validate([
            'content' => ['sometimes', 'string'],
        ]);

        $comment->update($validated);
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): Response
    {
        $comment->delete();
        return response()->noContent();
    }
}