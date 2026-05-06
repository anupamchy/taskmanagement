<?php
namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getUserTasks($request)
    {
        return Task::where('user_id', auth()->id())

            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->search}%");
            })

            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            ->latest()
            ->paginate(5);
    }

    public function store(array $data)
    {
        $data['user_id'] = auth()->id();

        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        return $task->update($data);
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }
}
