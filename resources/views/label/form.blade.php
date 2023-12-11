@include('flash::message')
<div>
    {{ Form::label('name', __('label.Label name')) }}
</div>
<div class="mt-5">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
</div>
@foreach($errors->get('name') as $message)
    <div class="text-rose-600">
        {{ $message }}
    </div>
@endforeach
<div class="mt-2">
    {{ Form::label('description', __('label.Description')) }}
</div>
<div >
    {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32']) }}
</div>
