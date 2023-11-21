<div>
    {{ Form::label('name', __('taskStatus.Status name')) }}
</div>
<div class="mt-5">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
</div>
@include('flash::message')
@if($errors->any())
    <div class="text-rose-600">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif