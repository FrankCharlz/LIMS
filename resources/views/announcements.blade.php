@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <div class="announcements">
                    <ul>
                        @foreach($announcements as $announcement)
                            <li data-href="/announcements/{{ $announcement->id }}">
                                <article>
                                        <h3>{{ $announcement->title }}</h3>

                                    <section class="byline">
                                        by <span class="author">{{ $announcement->authorFullName() }}</span>,
                                        <span class="date">{{ date('F d, Y H:m', strtotime($announcement->created_at)) }}</span>
                                    </section>

                                    <section class="phpcontent"> {!! substr(strip_tags($announcement->content), 0, 200) !!}</section>

                                </article>

                            </li>
                        @endforeach

                    </ul>

                </div>
                {{ $announcements->links() }}



            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <script>
        $(document).ready(function () {
            $('div.announcements li').click(function () {
                window.location = $(this).data('href');
            });
        });
    </script>
    <style type="text/css">

        div.announcements {
            /*font-family: calibri, lato, sans-serif;*/
            /*max-width: 79%;*/
        }

        div.announcements li {
            display: inline-block;
            width: 45%;
            padding: 20px;
            border: 1px solid #fff;
            border-radius: 0;
            vertical-align: top;
        }

        div.announcements li:hover{
            background: #f3f3f3;
            cursor: pointer;
        }

        span.author {
            font-weight: bold;
            color: #596794;
        }
        section.byline {
            font-style: italic;
            border-bottom: 1px dotted #e0eae0;
            font-family: calibri, serif;
        }

        article > h3 {
            margin-bottom: 2px;
            font-size: 2.3em;
        }

        a.title-link {
            text-decoration: none;
            color: black;
        }

    </style>
@endsection