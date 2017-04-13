@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h3>List of my land applications</h3>
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Owner's name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <?php $plot = \App\Plot::find($application['plot_id']); ?>
                        <tr>
                            <td>{{ $application['application_id']}}</td>
                            <td>{{ $plot->plot_number }}</td>
                            <td>{{ $plot->db_owner_name() }}</td>
                            <td>{{ $application['status'] or 'Pending'}}</td>
                            <td>{{ $application['created_at'] }}</td>
                            <td><i id="btn-del-app" class="fa fa-trash-o" aria-hidden="true"></i></td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <style>
                </style>


            </div>
        </div>
    </div>


@endsection