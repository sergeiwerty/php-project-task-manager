<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequests\StoreTaskRequest;
use App\Http\Requests\TaskStatusRequests\UpdateTaskStatusRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|View
     */
    public function index(): View|Application
    {
        $tasks = Task::orderBy('created_at', 'asc')->paginate();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|View
     */
    public function create(): View|Application
    {
        if (Auth::check()) {
            $task = new Task();
            $statuses = TaskStatus::all()->pluck('name', 'id');
            $performers = User::all()->pluck('name', 'id');
            $labels = Label::all()->pluck('name', 'id');

            return view('task.create', compact('task', 'statuses', 'labels', 'performers'));
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTaskRequest  $request
     *
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
            $validated = $request->validated();

            $task = new Task();
            $task->fill(array_merge($validated, ['created_by_id' => Auth::id()]));
            $task->saveOrFail();

            if (isset($request['labels'])) {
                $task->labels()->attach($request['labels']);
            }

            if (Task::find($task->id)) {
                flash(__('task.Task has been added successfully'))->success();

                return redirect()->route('tasks.index');
            }

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     *
     * @return Application|View
     */
    public function show(Task $task): Application|View
    {
        $task = Task::findOrFail($task->id);
        $labels = $task->labels;
        return view('task.show', compact('task', 'labels'));
    }

    /**
     * @param  Task  $task
     *
     * @return Application|View|RedirectResponse
     */
    public function edit(Task $task): Application|View|RedirectResponse
    {
        if (Auth::check()) {
            $task = Task::findOrFail($task->id);
            $statuses = TaskStatus::all()->pluck('name', 'id');
            $performers = User::all()->pluck('name', 'id');
            $labels = Label::all()->pluck('name', 'id');

            return view('task.edit', compact('task', 'statuses', 'labels', 'performers'));
        }
        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTaskStatusRequest  $request
     * @param  Task  $task
     *
     * @return RedirectResponse
     */
    public function update(UpdateTaskStatusRequest $request, Task $task): RedirectResponse
    {
        $task = Task::findOrFail($task->id);
        $validated = $request->validated();

        $task->fill(array_merge($validated, ['created_by_id' => Auth::id()]));
        $task->save();

        flash(__('task.Task has been updated successfully'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     *
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        if (Auth::check()) {
            if ($task->creator->id === Auth::id()) {
                $task->delete();
                flash(__('task.Task has been deleted successfully'))->success();
                return redirect()->route('tasks.index');
            }

            flash(__('task.Task has been deleted successfully'))->success();
            return redirect()->route('tasks.index');
        }
        return redirect('/login');
    }
}
