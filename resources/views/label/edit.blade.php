@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('label.Edit label') }}</h1>
        {{ Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}
        @csrf
        <div class="flex flex-col">
            @include('label.form')
            <div class="mt-5">
                {{ Form::submit(__('label.Update'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"])}}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection('content')