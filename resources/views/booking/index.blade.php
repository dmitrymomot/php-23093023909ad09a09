@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Booking <a href="{{ url('/booking/create') }}" class="btn btn-primary btn-xs" title="Add New Booking"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>City</th>
                    <th>Customer</th>
                    <th>Cleaner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($booking as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->dateTime() }}</td>
                    <td>{{ $item->cleaningDuration() }}</td>
                    <td>{{ $item->city->city }}, {{ $item->city->state }}</td>
                    <td>{{ $item->customer->name() }}</td>
                    <td>{{ $item->cleaner->name() }}</td>
                    <td>
                        <a href="{{ url('/booking/' . $item->id) }}" class="btn btn-success btn-xs" title="View Booking"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/booking/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Booking"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/booking', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Booking" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Booking',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $booking->render() !!} </div>
    </div>

</div>
@endsection
