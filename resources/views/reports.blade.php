@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <div id="plot-apps-div"></div>

                <div class="row" style="margin: 24px 0;">
                    <div style="border-right: 1px solid grey;" class="col-md-6"><div id="status-pie-div"></div></div>
                    <div class="col-md-6"><div id="usage-pie-div"></div></div>
                </div>

                <?= $lava->render('BarChart', 'Plots', 'plot-apps-div') ?>
                <?= $lava->render('PieChart', 'UsagePie', 'usage-pie-div') ?>
                <?= $lava->render('PieChart', 'StatusPie', 'status-pie-div') ?>

            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <style type="text/css">
    </style>
@endsection