@include('flash::message')
<div>
    {{ Form::label('name', __('task.Name')) }}
</div>
<div class="mt-2">
    {{ Form::text('name', null, ['class' => 'rounded border-gray-300 w-1/3']) }}
</div>
@foreach ($errors->get('name') as $message)
    <div class="text-rose-600">
        {{ $message }}
    </div>
@endforeach
<div class="mt-2">
    {{ Form::label('description', __('task.Description')) }}
</div>
<div >
    {{ Form::textarea('description', null, ['class' => 'rounded border-gray-300 w-1/3 h-32']) }}
</div>
<div class="mt-2">
    {{ Form::label('status_id', __('task.Status')) }}
</div>
<div >
    {{ Form::select('status_id', $statuses, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ]) }}
</div>
@foreach ($errors->get('status_id') as $message)
    <div class="text-rose-600">
        {{ $message }}
    </div>
@endforeach
<div class="mt-2">
    {{ Form::label('assigned_to_id', __('task.Performer')) }}
</div>
<div >
    {{ Form::select('assigned_to_id', $performers, null, [
        'class' => 'rounded border-gray-300 w-1/3',
        'placeholder' => '----------',
    ]) }}
</div>
<div class="mt-2">
    {{ Form::label('labels', __('task.Labels')) }}
</div>
<div >
    {{ Form::select('labels[]', $labels, is_null($task->labels) ? null : $task->labels, [
        'class' => 'form-control rounded border-gray-300 w-1/3',
        'multiple' => 'multiple',
        'placeholder' => ''
    ]) }}
</div>
