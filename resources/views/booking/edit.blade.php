@extends('layouts.app')

@section('content')
<div class="container">

    {!! dd($booking) !!}
    <h1>Edit Booking #{{ $booking->id }}</h1>

    {!! Form::model($booking, [
        'method' => 'PATCH',
        'url' => ['/booking', $booking->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
            {!! Form::label('customer_id', 'Customer', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('customer_id', $customers, $booking->customer_id, ['class' => 'form-control', 'placeholder' => 'Select customer...']) !!}
                {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cleaner_id') ? 'has-error' : ''}}">
            {!! Form::label('cleaner_id', 'Cleaner', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('cleaner_id', $cleaners, $booking->cleaner_id, ['class' => 'form-control', 'placeholder' => 'Select cleaner...']) !!}
                {!! $errors->first('cleaner_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
            {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('city_id', $cities, $booking->city_id, ['class' => 'form-control', 'placeholder' => 'Select city...']) !!}
                {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('date', $booking->date, ['class' => 'form-control']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
            {!! Form::label('time', 'Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::time('time', $booking->time, ['class' => 'form-control']) !!}
                {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
            {!! Form::label('duration', 'Duration (hours)', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('duration', $booking->duration, ['class' => 'form-control']) !!}
                {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
