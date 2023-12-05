@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h2 class="mb-5">
            {{ __('task.View a task') }}: {{ $task->name }}
            <a href="{{ route('tasks.edit', $task) }}">⚙</a>
        </h2>
        <p><span class="font-black">{{ __('task.Name') }}: </span>{{ $task->name }}</p>
        <p><span class="font-black">{{ __('task.Status') }}: </span>{{ $task->status->name }}</p>
        <p><span class="font-black">{{ __('task.Description') }}: </span>{{ $task->description }}</p>
        <p><span class="font-black">{{ __('task.Labels') }}: </span></p>
        <div>

        </div>
    </div>
@endsection('content')