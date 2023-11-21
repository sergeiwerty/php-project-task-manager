@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('taskStatus.Statuses') }}</h1>
        @auth
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                   href={{ route('task_statuses.create') }}>
                    {{ __('taskStatus.Create status') }}
                </a>
            </div>
        @endauth
        {{--        @include('flash::message')--}}
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th></th>
                <th>{{ __('taskStatus.Status name') }}</th>
                <th>{{ __('taskStatus.Date of creation') }}</th>
                <th>{{ __('taskStatus.Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($taskStatuses as $taskStatus)
                <tr class="border-b border-dashed text-left">
                    <th>{{ $taskStatus->id }}</th>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                    <td>
                        @canany(['update', 'delete'], $taskStatus)
                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                {{ __('taskStatus.Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900"
                               href="{{ route('task_statuses.edit', $taskStatus) }}">
                                {{ __('taskStatus.Edit') }}
                            </a>
                        @endcanany
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection('content')