@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('task.Tasks') }}</h1>
        @auth
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                   href={{ route('tasks.create') }}>
                    {{ __('task.Create task') }}
                </a>
            </div>
        @endauth
        @include('flash::message')
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('task.Status') }}</th>
                <th>{{ __('task.Name') }}</th>
                <th>{{ __('task.Author') }}</th>
                <th>{{ __('task.Performer') }}</th>
                <th>{{ __('task.Date of creation') }}</th>
                <th>{{ __('task.Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <th>{{ $task->id }}</th>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a href="{{ route('tasks.show', [$task]) }}"
                           class="text-blue-600 hover:text-blue-900">{{ $task->name }}
                        </a>
                    </td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{ is_null($task->performer) ? '' : $task->performer->name }}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', $task)
                            <a href="{{ route('tasks.destroy', $task) }}"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                {{ __('task.Delete') }}
                            </a>
                        @endcan
                        @can('update', $task)
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                {{ __('task.Edit') }}
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <div class="mx-auto pb-10 w-4/5">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
@endsection('content')