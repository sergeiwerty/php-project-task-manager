@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('label.Labels') }}</h1>
        @auth
            <div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                   href={{ route('labels.create') }}>
                    {{ __('label.Create label') }}
                </a>
            </div>
        @endauth
        @include('flash::message')
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('label.Label name') }}</th>
                <th>{{ __('label.Description') }}</th>
                <th>{{ __('label.Date of creation') }}</th>
                @auth
                    <th>{{ __('label.Actions') }}</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach ($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <th>{{ $label->id }}</th>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    <td>
                        @auth
                            <a href="{{ route('labels.destroy', $label) }}"
                               class="text-red-600 hover:text-red-900"
                               data-confirm="Вы уверены?"
                               data-method="delete"
                               rel="nofollow">
                                {{ __('label.Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">
                                {{ __('label.Edit') }}
                            </a>
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection('content')