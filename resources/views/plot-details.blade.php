@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <h4>Plot No. {{$plot->plot_number}}</h4>
                <span class="wapi">{{ $wapi }}</span>
                <div>
                    <span class="coord">Location: <a href="#"> {{$plot->latitude}}, {{$plot->longitude}}</a></span>
                    <button id="btn-buy" class="btn btn-default"><i class="fa fa-usd" aria-hidden="true"></i> Buy this Plot</button>
                </div>


                <table class="table table-responsive">
                    <thead>

                    </thead>

                    <tbody>

                    <tr>
                        <td>Owner name</td>
                        <td>{{ $plot->owner_name }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $plot->status->status_description }}</td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{{ $plot->description or 'No description' }}</td>
                    </tr>


                    <tr>
                        <td>Total area <i>(m<sup>2</sup>)</i></td>
                        <td> - </td>
                    </tr>

                    <tr>
                        <td>Certificate</td>
                        <td class="cert"><img src="/outis/{{ $cert->path }}"></td>
                    </tr>

                    <tr>
                        <td>Maps</td>
                        <td class="container-fluid maps">
                            <div id="gmap"></div>
                            <div id="smap"></div>
                        </td>
                    </tr>

                    </tbody>
                </table>

                {{-- for passing lat and long to js --}}
                <input type="hidden" id="lat" value="{{$plot->latitude}}">
                <input type="hidden" id="lng" value="{{$plot->longitude}}">




            </div>

        </div>
    </div>

    <div class="buy-popup-mask">
        <div class="buy-popup-wrapper">
            <div class="buy-popup-container">
                <h3>Plot application confirmation</h3>
                <p>Dear <b>{{ Auth::user()->firstname }}</b>, please confirm your application for this plot
                    <b>Plot {{ $plot->plot_number }}</b>.
                </p>

                <button id="btn-buy-cancel" class="btn btn-danger">Cancel</button>
                <button id="btn-buy-confirm" class="btn btn-success">Confirm</button>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByP5hKqYp0Y4HmBFYPkwB4Hdu9Yar6Vo8&callback=initMap">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            function initMap() {

                var point = {
                    lat: parseFloat(document.getElementById('lat').value),
                    lng: parseFloat(document.getElementById('lng').value)
                };
                var zoom = 20;

                var gmap = new google.maps.Map(document.getElementById('gmap'), {
                    zoom: zoom,
                    center: point,
                    mapTypeId: 'satellite',
                    disableDefaultUI: true
                });

                var smap = L.map('smap').setView([ point.lat, point.lng], zoom);
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy;<a href="http://osm.org/copyright">OpenStreetMap</a>'
                }).addTo(smap);
                smap.dragging.disable();
                smap.touchZoom.disable();
                smap.doubleClickZoom.disable();
                smap.scrollWheelZoom.disable();
                smap.boxZoom.disable();
                smap.keyboard.disable();
                if (smap.tap) smap.tap.disable();

            }

            initMap();
        });

    </script>

    <script src="{{ asset('/js/plot.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/plot-details.css') }}"/>

@endsection