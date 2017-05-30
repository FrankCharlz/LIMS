@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h2>Registered users (<span id="t">{{ $_GET['t'] or 'all' }}</span> ), {{ sizeof($users) }}</h2>
                <hr>

                <ul class="nav nav-tabs">
                    <li><a href="/users/manage?t=all">All</a></li>
                    <li><a href="/users/manage?t=admins">Admins</a></li>
                    <li><a href="/users/manage?t=managers">Managers</a></li>
                    <li><a href="/users/manage?t=deactivated">Deactivated</a></li>
                </ul>

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date registered</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="td-name">{{ $user->firstname . ' '. $user->othernames }}</td>
                                <td>{{ $user->role_id }}</td>
                                <td style="color: #0f8cd3">{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            //make active tab active :)
            var t = $('#t').html();

            $('ul.nav-tabs li').each(function () {
                if ($(this).first('a').html().includes(t)) {
                    $(this).addClass('active');
                    return false;
                }
            });

        });

    </script>

@endsection

@section('custom-css')
    <style type="text/css">
        .td-name {text-transform: capitalize;}
    </style>
@endsection