<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {

        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getUserTasks($request);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->store($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Created');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);

        $this->taskService->update(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Updated');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $this->taskService->delete($task);

        return back()->with('success', 'Task Deleted');
    }

    private function authorizeTask(Task $task)
    {
        abort_if($task->user_id != auth()->id(), 403);
    }
}
