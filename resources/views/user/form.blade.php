@if($errors->has())
    @foreach ($errors->all() as $error)
 0       <div>{{ $error }}</div>
    @endforeach
@endif

{!! Form::open(['url' => URL::route('store-user')]) !!}
<div>
    {!! Form::email('email', '') !!}
    @if(in_array('email', $errors->keys()))
        <p>{{ $errors->get('email')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::password('password', '') !!}
    @if(in_array('password', $errors->keys()))
        <p>{{ $errors->get('password')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::password('password_confirmation', '') !!}
    @if(in_array('password_confirmation', $errors->keys()))
        <p>{{ $errors->get('password_confirmation')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::text('first_name', '') !!}
    @if(in_array('first_name', $errors->keys()))
        <p>{{ $errors->get('first_name')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::text('last_name', '') !!}
    @if(in_array('last_name', $errors->keys()))
        <p>{{ $errors->get('last_name')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::text('middle_name', '') !!}
    @if(in_array('middle_name', $errors->keys()))
        <p>{{ $errors->get('middle_name')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::select('sex', ['M' => 'Male', 'F' => 'Female']) !!}
    @if(in_array('sex', $errors->keys()))
        <p class="alert-danger">{{ $errors->get('sex')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::select('department_id', [1 => 'test', 2 => 'test2']) !!}
    @if(in_array('department_id', $errors->keys()))
        <p class="alert-danger">{{ $errors->get('department_id')[0]  }}</p>
    @endif
</div>

<div>
    {!! Form::select('position_id', [1 => 'pos 1', 2 => 'pos 2']) !!}
    @if(in_array('position_id', $errors->keys()))
        <p class="alert-danger">{{ $errors->get('position_id')[0]  }}</p>
    @endif
</div>

<button type="submit">Submit</button>
{!! Form::close() !!}