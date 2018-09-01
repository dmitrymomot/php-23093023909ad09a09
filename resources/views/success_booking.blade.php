@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Your Booking</h2></div>
                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $booking->id }}</td>
                            </tr>
                            <tr><th>Customer</th><td>{{ $booking->customer->name() }}</td></tr>
                            <tr><th>Cleaner</th><td>{{ $booking->cleaner->name() }}</td></tr>
                            <tr><th>Date</th><td>{{ $booking->dateTime() }}</td></tr>
                            <tr><th>Duration</th><td>{{ $booking->cleaningDuration() }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
