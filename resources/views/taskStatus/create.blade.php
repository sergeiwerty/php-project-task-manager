@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{__('taskStatus.Create status')}}</h1>
        {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
        @csrf
        <div class="flex flex-col">
            @include('taskStatus.form')
            <div class="mt-5">
                {{ Form::submit(__('taskStatus.Create'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection('content')