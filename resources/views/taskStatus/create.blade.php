@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">Создать статус</h1>

        <form method="POST" action={{ route('task_statuses.store') }} accept-charset="UTF-8" class="w-50"><input
                    name="_token" type="hidden" value="MdIk8ide4faA7xCnUnHvujMBanOY8F6tFGu07xPa">
            <div class="flex flex-col">
                <div>
                    <label for="name">Имя</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name">
                </div>
                <div class="mt-2">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"
                           value="Создать">
                </div>
            </div>
        </form>

        {{ Form::model($taskStatus, ['url' => route('task_statuses.store'), 'class' => 'w-50']) }}
        @csrf
        <div class="flex flex-col">
            @include('taskStatus.form')
            @if($errors->any())
                <div class="text-rose-600">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            @include('flash::message')

            <div class="mt-5">
                {{ Form::submit('Создать', ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection('content')