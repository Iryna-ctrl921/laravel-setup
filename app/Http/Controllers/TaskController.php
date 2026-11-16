<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::with(['project', 'comments'])->paginate(10));
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $data = $request->validated();
        
        $task = Task::create($data);
        return new TaskResource($task);
    }

    public function show(Task $task): TaskResource
    {
        return new TaskResource($task->load(['project', 'comments']));
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();
        return response()->noContent();
    }
}