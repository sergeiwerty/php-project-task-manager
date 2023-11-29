<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();

        return view('taskStatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()){
            $taskStatus = new TaskStatus();

            return view('taskStatus.create', compact('taskStatus'));
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required|max:50|unique:App\Models\TaskStatus'
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:50' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The status name has already been taken'),
            ]);

            $taskStatus = new TaskStatus();
            $taskStatus->fill($request->all());
            $taskStatus->save();

            if (TaskStatus::find($taskStatus->id)) {
                flash(__('taskStatus.Status has been added successfully'))->success();
            }

            return redirect()->route('task_statuses.index');
        }

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::findOrFail($taskStatus->id);

            return view('taskStatus.edit', compact('taskStatus'));
        }

        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::findOrFail($taskStatus->id);
            $this->validate($request, [
                'name' => 'required|max:50|unique:App\Models\TaskStatus',
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:50' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The task name has already been taken'),
            ]);

            $taskStatus->fill($request->all());
            $taskStatus->save();
            if (TaskStatus::find($taskStatus->id)) {
                flash(__('taskStatus.Status has been updated successfully'))->success();
            }

            return redirect()->route('task_statuses.index');
        }

        return redirect('/login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (Auth::check()) {
//            if (!$taskStatus->tasks()->exists()) {
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
