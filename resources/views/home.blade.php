@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- if user kalogin --}}
            @include('sidenav') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126744.65162481589!2d39.273472396120106!3d-6.918034291705006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185dd65026f1dc1b%3A0xbd8177b467450191!2sTemeke%2C+Tanzania!5e0!3m2!1sen!2s!4v1490258563971"
                        width="1000" height="480" frameborder="0"
                        style="border:0; overflow-x: hidden;" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
