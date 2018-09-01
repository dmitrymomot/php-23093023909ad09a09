@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Booking {{ $booking->id }}
        <a href="{{ url('booking/' . $booking->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Booking"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['booking', $booking->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Booking',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $booking->id }}</td>
                </tr>
                <tr><th>Customer</th><td><a href="{{ route('customer.show', ['id' => $booking->customer->id]) }}">{{ $booking->customer->name() }}</a></td></tr>
                <tr><th>Cleaner</th><td><a href="{{ route('customer.show', ['id' => $booking->cleaner->id])}}">{{ $booking->cleaner->name() }}</a></td></tr>
                <tr><th>Date</th><td>{{ $booking->dateTime() }}</td></tr>
                <tr><th>Duration</th><td>{{ $booking->cleaningDuration() }} hours</td></tr>
                <tr><th>City</th><td>{{ $booking->city->city }}, {{ $booking->city->state }}</td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
