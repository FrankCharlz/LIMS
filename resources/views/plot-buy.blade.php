@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <h2>Plot details</h2>

                @foreach($plot->getAttributes() as $key => $value)
                    {{ str_replace('_', ' ', $key) }} : {{ $value }} <br>
                @endforeach

                <div>
                    <h3>Plot application confirmation</h3>
                    <p>Dear <b>{{ Auth::user()->firstname }}</b>, please confirm your application/purchase for this plot
                        <b>Plot {{ $plot->plot_number }}</b>.
                    </p>

                    <div class="pay-options">
                        <button id="btn-buy-cancel" class="btn">Pay now</button>
                    </div>

                    <div class="pay-options">
                        <button id="btn-buy-confirm" class="btn" data-pid="{{ $plot->id }}">Pay later</button>
                        <p>**Plot will be added to your land applications.</p>
                    </div>

                </div>


            </div>

        </div>
    </div>


@endsection

@section('custom-css')
    <style type="text/css">

        .pay-options {
            vertical-align: top;
            display: inline-block;
            margin-right: 12px;
        }

        .pay-options > p {
            font-size: 12px;
            font-style: italic;
            margin: -2px 0 0 4px;
        }



    </style>

@endsection