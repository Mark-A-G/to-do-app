<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show(): AnonymousResourceCollection
    {
        return TaskResource::collection(Auth::user()->tasks);
    }

    public function store(TaskStoreRequest $request): array
    {
        Auth::user()->tasks()->create($request->validated());

        return ['success' => true, 'message' => 'Task created successfully.'];
    }

    public function destroy(int $task_id): array
    {
        if (Auth::user()->tasks->contains($task_id)) {
            Auth::user()->tasks()->where('id', $task_id)->delete();

            return ['success' => true, 'message' => 'Task deleted successfully.'];
        }

        return ['success' => false, 'message' => 'Failed to delete task.'];
    }
}
