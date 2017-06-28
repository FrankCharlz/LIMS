@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h2>List of my land applications, {{ sizeof($applications) }}</h2>
                <hr>

                @php( $statuses = ['Pending', 'Cancelled', 'Deleted', 'Complete'])

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Location</th>
                        <th>Owner's name</th>
                        <th>Status</th>
                        <th>Date applied</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        @php( $plot = \App\Plot::find($application['plot_id']) )
                        <tr class="tr-plot-link" data-href="/plots/view/{{$plot->id}}">
                            <td>{{ $application['id']}}</td>
                            <td>{{ $plot->plot_number }}</td>
                            <td>{{ $plot->wapi() }}</td>
                            <td>{{ $plot->db_owner_name() }}</td>
                            <td>{{ $statuses[$application['status']]}}</td>
                            <td>{{ $application['created_at'] }}</td>
                            <td>
                                <i data-id="{{$application['id']}}"
                                   class="fa fa-ellipsis-h btn-options" aria-hidden="true">
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

        .btn-options {
            font-size: 2.4rem!important;
            padding: 0 12px;
            color: #da4848;
        }

        .btn-options:hover {
            font-weight: bold;
        }

    </style>
@endsection