<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequests\StoreTaskStatusRequest;
use App\Http\Requests\TaskStatusRequests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Throwable;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|View
     */
    public function index(): View|Application
    {
        $taskStatuses = TaskStatus::all();

        return view('taskStatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|View|RedirectResponse
     */
    public function create(): Application|View|RedirectResponse
    {
        if (Auth::check()) {
            $taskStatus = new TaskStatus();

            return view('taskStatus.create', compact('taskStatus'));
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTaskStatusRequest  $request
     *
     * @return Application|RedirectResponse
     *
     * @throws ValidationException
     * @throws Throwable
     */
    public function store(StoreTaskStatusRequest $request): Application|RedirectResponse
    {
        $validated = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($validated);
        $taskStatus->saveOrFail();

        if (TaskStatus::find($taskStatus->id)) {
            flash(__('taskStatus.Status has been added successfully'))->success();
        }

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TaskStatus  $taskStatus
     *
     * @return Application|View|RedirectResponse
     */
    public function edit(TaskStatus $taskStatus): View|RedirectResponse|Application
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::findOrFail($taskStatus->id);

            return view('taskStatus.edit', compact('taskStatus'));
        }

        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTaskStatusRequest  $request
     * @param  TaskStatus  $taskStatus
     *
     * @return RedirectResponse
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus = TaskStatus::findOrFail($taskStatus->id);
        $validated = $request->validated();

        $taskStatus->fill($validated);
        $taskStatus->save();
        if (TaskStatus::find($taskStatus->id)) {
            flash(__('taskStatus.Status has been updated successfully'))->success();
        }

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TaskStatus  $taskStatus
     *
     * @return Application|RedirectResponse
     */
    public function destroy(TaskStatus $taskStatus): RedirectResponse|Application
    {
        if (Auth::check()) {
            if (!$taskStatus->tasks()) {
                $taskStatus->delete();
                flash(__('taskStatus.Status has been deleted successfully'))->success();
                return redirect()->route('task_statuses.index');
            }
            flash(__('taskStatus.Failed to delete status'))->error();

            return redirect()->route('task_statuses.index');
        }

        return redirect('/login');
    }
}
