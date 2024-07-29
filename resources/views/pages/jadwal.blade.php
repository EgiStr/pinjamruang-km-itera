@extends('layouts.default')
@section('metas')
    <title>Jadwal Ruangan | KM-ITERA </title>
    {{-- meta tags --}}
    <meta name="description" content="Jadwal Peminjaman ruang KM-ITERA">
    <meta name="keywords" content="Jadwal Peminjaman, KM-ITERA, Ruang Sekre KM itera, Gedung e itera">
    <meta name="author" content="KM-ITERA">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="Indonesia">
    <meta name="webcrawlers" content="all">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="coverage" content="Worldwide">
    <meta name="rating" content="Safe For Kids">
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Open Graph --}}
    <meta property="og:title" content="Jadwal Ruangan | KM-ITERA">
    <meta property="og:description" content="Jadwal Peminjaman ruang KM-ITERA">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('jadwal') }}">
    <meta property="og:image"
        content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
    <meta property="og:site_name" content="KM-ITERA">
    <meta property="og:locale" content="id_ID">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Gedung Laboratorium Teknik ITERA">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@km_itera">
    <meta name="twitter:creator" content="@km_itera">
    <meta name="twitter:title" content="Jadwal Ruangan | KM-ITERA">
    <meta name="twitter:description" content="Jadwal Peminjaman ruang KM-ITERA">
    <meta name="twitter:image"
        content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
    <meta name="twitter:image:alt" content="Gedung Laboratorium Teknik ITERA">
    <meta name="twitter:url" content="{{ route('jadwal') }}">
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="KM-ITERA">
    <meta name="twitter:label2" content="Est. reading time">
    <meta name="twitter:data2" content="0 minutes">
    <meta name="twitter:site" content="@km_itera">
    <meta name="twitter:creator" content="@km_itera">
    <meta name="twitter:image:src"
        content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
    <meta name="twitter:image:width" content="1200">
    <meta name="twitter:image:height" content="675">
    <meta name="twitter:image:alt" content="Gedung Laboratorium Teknik ITERA">
    <meta name="twitter:domain" content="km-itera.itera.ac.id">
    <meta name="twitter:app:name:iphone" content="KM-ITERA">
    <meta name="twitter:app:id:iphone" content="id1523442076">
    <meta name="twitter:app:name:googleplay" content="KM-ITERA">
    <meta name="twitter:app:id:googleplay" content="id.ac.itera.km.itera">
    <meta name="twitter:app:country" content="ID">

    {{-- canonical --}}
    <link rel="canonical" href="{{ route('jadwal') }}">
    <link rel="shortlink" href="{{ route('jadwal') }}">
    <link rel="alternate" href="{{ route('jadwal') }}" hreflang="id" />
    <link rel="alternate" href="{{ route('jadwal') }}" hreflang="x-default" />
    <link rel="alternate" href="{{ route('jadwal') }}" hreflang="en" />
    <link rel="alternate" href="{{ route('jadwal') }}" hreflang="id-ID" />
@endsection

@section('content')
    <section class="hero-wrap hero-wrap-2"
        style="background-image: url('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Beranda <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Jadwal <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Kalender Ruangan</h1>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div id="calendar"></div>
    </section>
< @section('scripts') <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        // show data
        const data = @json($data);



        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'today',
                    center: 'title',
                    right: 'prev,next'
                },
                events: data.borrow_rooms.map((item) => {
                    return {
                        // display title name room and organization
                        title: item.room_name + ' - ' + item.borrower_data.organization,

                        // parse date
                        start: item.borrow_at,
                        end: item.until_at,
                        editable: false,
                        allDay: true,

                    }
                })

            });
            calendar.render();
        });
    </script>
@endsection
@endsection
