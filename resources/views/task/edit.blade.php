@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{__('task.Edit task')}}</h1>
        {{ Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH', 'class' => 'w-50']) }}
        @csrf
        <div class="flex flex-col">
            @include('task.form')
            <div class="mt-5">
                {{ Form::submit(__('task.Update'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection('content')