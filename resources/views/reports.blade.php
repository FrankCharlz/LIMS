@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <div class="row">
                    <h2>Land applications statistics (by plot)</h2>
                    <div id="chart_div"></div>
                </div>

            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        function chrt(d) {
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {

                var data = google.visualization.arrayToDataTable(
                    d
                );

                var options = {
                    title: 'Plots applications frequencies',
                    chartArea: {width: '80%'},
                    height: 420,
                    hAxis: {
                        title: 'Total Frequency',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Plot'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                chart.draw(data, options);
            }
        }
        $(document).ready(function () {

            var prepare = function (data) {
                var d = [];
                d.push(['Plot', 'Application Freq']);
                for( var i = 0; i < data.length; i++) {
                    d.push([data[i]['plot_number'], data[i]['idadi']]);
                    chrt(d);
                }

                console.log(d);

            };


            $.ajax({
                url: '/reports/applications/most-applied',
                data: {},
                success: function (data) {console.log('done loading appls data'); console.log(data); prepare(data);},
                dataType: null,
                done:null
            });

            //chrt();


        });
    </script>
    <style type="text/css">
    </style>
@endsection