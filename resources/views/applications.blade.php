@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h2>List of my land applications, {{ sizeof($applications) }}</h2>
                <hr>

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Location</th>
                        <th>Owner's name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        @php( $plot = \App\Plot::find($application['plot_id']) )
                        <tr>
                            <td>{{ $application['id']}}</td>
                            <td>{{ $plot->plot_number }}</td>
                            <td>{{ $plot->wapi() }}</td>
                            <td>{{ $plot->db_owner_name() }}</td>
                            <td>{{ $application['status'] or 'Pending'}}</td>
                            <td>{{ $application['created_at'] }}</td>
                            <td><i data-id="{{$application['id']}}"
                                   class="fa fa-trash-o btn-del-app" aria-hidden="true">
                                </i>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <script type="text/javascript" src="{{ asset('/js/application.js') }}"></script>
            </div>
        </div>
    </div>

@endsection


@section('custom-css')
    <style>
        td {text-transform: capitalize;}
    </style>
@endsection