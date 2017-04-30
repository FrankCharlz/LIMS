@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <div class="p-info">
                    <h4>Plot {{$plot->plot_number}}</h4>
                    <span class="wapi">{{ $wapi }}</span>
                    <span class="coord">Location: <a href="#"> {{$plot->latitude}}, {{$plot->longitude}}</a></span>

                    @php
                        if (Auth::guest()) $apps = []; //set size of apps to zero for non
                        else $apps = Auth::user()->hasAppliedFor($plot->id)
                    @endphp

                    @if(sizeof($apps) > 0)
                        <span class="pull-right a-application">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                You made an application for this plot on <b>{{ $apps[0]['created_at'] }}</b>
                            </span>
                    @else
                        @if(Auth::guest())
                            <button id="btn-login-to-buy" class="btn btn-default btn-plot-actions pull-right">
                                Login to buy this plot
                            </button>
                        @elseif(Auth::id() === $plot->owner_id)
                            <button id="btn-sell" class="btn btn-default btn-plot-actions pull-right">
                                Put on Sale
                            </button>
                        @else
                            <button id="btn-buy" class="btn btn-default btn-plot-actions pull-right">
                                Buy this Plot
                            </button>
                        @endif
                    @endif


                </div>




                <table class="table table-responsive">
                    <thead>

                    </thead>

                    <tbody>

                    <tr>
                        <?php
                        $owner = \App\User::find($plot->owner_id); //todo: optimize this, get required fields only
                        $owner_name = $owner->firstname. ' '.$owner->othernames;
                        ?>
                        <td>Owner name</td>
                        <td>{{ $owner_name }}</td>
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
                        <td style="font-family: 'Source Sans Pro', serif"> {{ $plot->area }} </td>
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

    {{-- only prepare this if user is logged in --}}
    @if(Auth::user())
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3>Plot application confirmation</h3>
                    <p>Dear <b>{{ Auth::user()->firstname }}</b>, please confirm your application for this plot
                        <b>Plot {{ $plot->plot_number }}</b>.
                    </p>

                    <button id="btn-buy-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-buy-confirm" class="btn btn-success" data-pid="{{ $plot->id }}">Confirm</button>

                </div>
            </div>
        </div>
    @endif

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