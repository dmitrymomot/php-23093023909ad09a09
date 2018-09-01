@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Book the cleaning</h2></div>
                <div class="panel-body">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                            {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => '(555)-555-5555']) !!}
                                {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
                            {!! Form::label('city_id', 'City', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::select('city_id', $cities, null, ['class' => 'form-control', 'placeholder' => 'Select your city...']) !!}
                                {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                            {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::date('date', \Carbon\Carbon::now()->addDays(1), ['class' => 'form-control']) !!}
                                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
                            {!! Form::label('time', 'Time', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::time('time', '09:00', ['class' => 'form-control']) !!}
                                {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
                            {!! Form::label('duration', 'Duration (hours)', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-7">
                                {!! Form::number('duration', 2, ['class' => 'form-control']) !!}
                                {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Submit Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
