@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Cities <a href="{{ url('/city/create') }}" class="btn btn-primary btn-xs" title="Add New City"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>City</th><th>State</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($city as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->city }}</td><td>{{ $item->state }}</td>
                    <td>
                        <a href="{{ url('/city/' . $item->id) }}" class="btn btn-success btn-xs" title="View city"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/city/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit city"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/city', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete city" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete city',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $city->render() !!} </div>
    </div>

</div>
@endsection
