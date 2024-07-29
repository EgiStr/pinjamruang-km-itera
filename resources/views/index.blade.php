@extends('layouts.default')

@section('metas')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Aplikasi peminjaman ruangan di kampus Institut Teknologi Sumatera. Mudah digunakan untuk memesan ruangan secara online.">
    <meta name="keywords"
        content="Peminjaman ruangan kampus, Peminjaman ruangan ITERA, Sistem informasi peminjaman ruangan, Booking ruangan kampus, Aplikasi peminjaman ruangan, Reservasi ruangan ITERA, Sistem booking ruangan kampus">
    <meta name="author" content="Nama Anda atau Tim Pengembang">
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

    <title>Pinjam Ruang | KM-ITERA </title>

    <!-- Social Media Meta Tags -->
    <meta property="og:title" content="Peminjaman Ruangan Kampus ITERA">
    <meta property="og:description"
        content="Aplikasi peminjaman ruangan di kampus Institut Teknologi Sumatera. Mudah digunakan untuk memesan ruangan secara online.">
    <meta property="og:image" content="{{ asset('assets/Gerbang-ITERA-Drone-2-1536x946.jpg') }}">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:site_name" content="KM-ITERA">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Gerbang Institut Teknologi Sumatera">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@km_itera">
    <meta name="twitter:creator" content="@km_itera">
    <meta name="twitter:title" content="Peminjaman Ruangan Kampus ITERA">
    <meta name="twitter:description"
        content="Aplikasi peminjaman ruangan di kampus Institut Teknologi Sumatera. Mudah digunakan untuk memesan ruangan secara online.">
    <meta name="twitter:image" content="{{ asset('assets/Gerbang-ITERA-Drone-2-1536x946.jpg') }}">
    <meta name="twitter:image:alt" content="Gerbang Institut Teknologi Sumatera">
    <meta name="twitter:url" content="{{ route('home') }}">
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="KM-ITERA">
    <meta name="twitter:label2" content="Est. reading time">
    <meta name="twitter:data2" content="0 minutes">
    <meta name="twitter:site" content="@km_itera">
    <meta name="twitter:creator" content="@km_itera">
    <meta name="twitter:image:src" content="{{ asset('assets/Gerbang-ITERA-Drone-2-1536x946.jpg') }}">
    <meta name="twitter:image:width" content="1200">
    <meta name="twitter:image:height" content="675">
    <meta name="twitter:image:alt" content="Gerbang Institut Teknologi Sumatera">
    <meta name="twitter:domain" content="km-itera.itera.ac.id">
    <meta name="twitter:app:name:iphone" content="KM-ITERA">
    <meta name="twitter:app:id:iphone" content="id1523442076">
    <meta name="twitter:app:name:googleplay" content="KM-ITERA">
    <meta name="twitter:app:id:googleplay" content="id.ac.itera.km.itera">
    <meta name="twitter:app:country" content="ID">

    {{-- canonical --}}
    <link rel="canonical" href="{{ route('home') }}">
    <link rel="shortlink" href="{{ route('home') }}">
    <link rel="alternate" href="{{ route('home') }}" hreflang="id" />
    <link rel="alternate" href="{{ route('home') }}" hreflang="x-default" />
    <link rel="alternate" href="{{ route('home') }}" hreflang="en" />

    {{-- import css  --}}
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
@endsection

@section('content')

    <div class="hero-wrap js-fullheight"
        style="background-image: url('assets/Gerbang-ITERA-Drone-2-1536x946.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <div class="text w-100">
                        <div class="icon">
                            <span class="flaticon-architect"></span>
                        </div>
                        <h2 class="subheading
                    ">Selamat datang di Pinjam Ruang - KM ITERA</h2>
                        <h1 class="mb-4">Pinjam ruangan dengan mudah</h1>
                    </div>
                </div>
            </div>
        </div>

        <section id="form-pinjam-ruang" class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-4">
                        <form method="POST" action="{{ route('api.v1.borrow-room-with-college-student', []) }}"
                            class="appointment-form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-3">Pinjam ruang disini</h3>
                            {{-- Show any errors --}}
                            @if ($errors->isNotEmpty())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $message)
                                        @if ($message == 'login_for_more_info')
                                            <a href="{{ route('admin.login') }}">Masuk</a> untuk meilihat aktivitas
                                            peminjaman.
                                        @else
                                            {{ $message }}<br>
                                        @endif
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Pinjam ruang berhasil, silahkan cek status peminjaman <a
                                        href="{{ route('admin.login') }}">disini</a>. Masuk menggunakan username dan
                                    password
                                    NIM.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="full_name" value="{{ old('full_name') }}" type="text"
                                            class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="nim" type="text" value="{{ old('nim') }}"
                                            class="form-control" placeholder="Nomor Induk Mahasiswa">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="organization" type="text" value="{{ old('organization') }}"
                                            class="form-control" placeholder="Organisasi">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="phone" type="text" value="{{ old('phone') }}"
                                            class="form-control" placeholder="Nomor Telpon (Whatsapp)">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-wrap">
                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                            <div class="input-container" id="date-picker-container">
                                                <label for="borrow_at">Tanggal Masuk</label>
                                                <input type="date" id="borrow_at" class="until_at" name="borrow_at">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-wrap">
                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                            <div class="input-container" id="date-picker-container">
                                                <label for="until_at">Tanggal Selesai</label>
                                                <input type="date" id="until_at" name="until_at" class="until_at">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                <select name="room" id="" class="form-control">
                                                    <option value="" selected disabled>Pilih ruangan</option>
                                                    @forelse ($data['rooms'] as $room)
                                                        <option value="{{ $room->id }}"
                                                            @if (old('room') == $room->id) selected @endif>
                                                            {{ $room->room_type->name . ' - ' . $room->name }}
                                                        </option>
                                                    @empty
                                                        <option value="" disabled>Belum ada ruangan yang tersedia
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- create upload file col-md-12  --}}
                                <div class="col-md-12 mb-2">
                                    <div class="form-group custom-file">
                                        <input type="file" class="custom-file-input form-control"
                                            id="surat_peminjaman" name="surat_peminjaman">
                                        <label class="custom-file-label" for="surat_peminjaman">Upload Surat
                                            Peminjaman</label>
                                    </div>
                                </div>

                                <div class="col-md-12 p-6">
                                    <div class="form-group">
                                        <input type="submit" value="Pinjam Ruang Sekarang"
                                            class="btn btn-primary py-3 px-4">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Tata Cara Peminjaman Ruang Sektretariat KM</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12 wrap-about">
                        <div class="text-center">
                            <img src="{{ asset('assets/alur_sekre_km_itera.jpg') }}" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section bg-light">
            <div class="container-fluid px-md-0">
                <div class="row no-gutters justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Ruangan</h2>
                        <p class="justify-content-center"><a href="{{ route('rooms') }}">Lihat lebih banyak ruangan
                                disini.</a></p>
                    </div>
                </div>
                <div class="row no-gutters">
                    @for ($i = 0; $i < 2; $i++)
                        @php
                            // Get Random rooms
                            $room = $data['rooms'][rand(0, $data['rooms']->count() - 1)];

                            $borrower_status = [];

                            // Check if any borrow rooms
                            if ($room->borrow_rooms->isNotEmpty()) {
                                // Check each borrow_rooms
                                foreach ($room->borrow_rooms as $key => $borrow_room) {
                                    // Show details if not finished yet by checking status first
                                    if (
                                        $borrow_room->finished_at == null &&
                                        $borrow_room->admin_approval_status == App\Enums\ApprovalStatus::Disetujui
                                    ) {
                                        $room_status = 1; // Set status room to Booked
                                        $borrower_first_name = ucfirst(
                                            strtolower(
                                                explode(
                                                    ' ',
                                                    Encore\Admin\Auth\Database\Administrator::find(
                                                        $borrow_room->borrower_id,
                                                    )->name,
                                                )[0],
                                            ),
                                        );

                                        $borrow_at = Carbon\Carbon::parse($borrow_room->borrow_at);
                                        $until_at = Carbon\Carbon::parse($borrow_room->until_at);
                                        $count_days = $borrow_at->diffInDays($until_at) + 1;

                                        if ($count_days == 1) {
                                            $borrower_status[] =
                                                $borrower_first_name . ' - ' . $borrow_at->format('d M Y');
                                        } else {
                                            $borrower_status[] =
                                                $borrower_first_name .
                                                ' - ' .
                                                $borrow_at->format('d M Y') .
                                                ' s.d ' .
                                                $until_at->format('d M Y');
                                        }
                                    }
                                }
                            }
                        @endphp
                        <div class="col-lg-6">
                            <div class="room-wrap d-md-flex">
                                <a href="#" class="img"
                                    style="background-image: url({{ asset('assets/gedung_e.jpg') }});"></a>
                                <div class="half left-arrow d-flex align-items-center">
                                    <div class="text p-4 p-xl-5 text-center">
                                        <p class="star mb-0"><span class="fa fa-star"></span><span
                                                class="fa fa-star"></span><span class="fa fa-star"></span><span
                                                class="fa fa-star"></span><span class="fa fa-star"></span></p>
                                        <p class="mb-0">{{ $room->room_type->name }}</p>
                                        <h3 class="mb-3"><a href="javascript:void(0)">{{ $room->name }}</a></h3>
                                        <ul class="list-accomodation">
                                        </ul>
                                        <!-- Button trigger modal -->
                                        <p class="pt-1"><a href="javascript:void(0)" id="buttonBorrowRoomModal"
                                                class="btn-custom px-3 py-2" data-toggle="modal"
                                                data-target="#borrowRoomModal" data-room-id="{{ $room->id }}"
                                                data-room-name="{{ $room->name }}">Pinjam Ruang Ini <span
                                                    class="icon-long-arrow-right"></span></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Tata Cara Peminjaman Gedung FS</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12 wrap-about">
                        <div class="text-center">
                            <img src="{{ asset('/assets/fsains.png') }}" class="img-fluid"
                                alt="Tata Cara Peminjaman Gedung FAKULTAS SAINS (FS) Institut Teknologi Sumatera (ITERA)">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Tata Cara Peminjaman Gedung FTIK</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12 wrap-about">
                        <div class="text-center">
                            <img src="{{ asset('/assets/ftik.png') }}" class="img-fluid"
                                alt="Tata Cara Peminjaman Gedung FTIK Institut Teknologi Sumatera (ITERA)">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Tata Cara Peminjaman Gedung FTI</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12 wrap-about">
                        <div class="text-center">
                            <img src="{{ asset('/assets/fti.png') }}" class="img-fluid"
                                alt="Tata Cara Peminjaman Gedung FTI Institut Teknologi Sumatera (ITERA)">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Tata Cara Peminjaman Fasilitas Olahraga ITERA</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12 wrap-about">
                        <div class="text-center">
                            <img src="{{ asset('/assets/FASILITAS_OLAHRAGA_ITERA.png') }}" class="img-fluid"
                                alt="Tata Cara Peminjaman Fasilitas Olahraga Institut Teknologi Sumatera (ITERA)">
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <!-- Modal -->
        <div class="modal fade" id="borrowRoomModal" tabindex="-1" role="dialog"
            aria-labelledby="borrowRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="borrowRoomModalLabel">Pinjam Ruang - Nama Ruang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('api.v1.borrow-room-with-college-student', []) }}"
                            class="appointment-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Hidden input for room_id --}}
                                <input type="hidden" name="room" id="room" value="">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="full_name" type="text" class="form-control"
                                            placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="nim" type="text" class="form-control"
                                            placeholder="Nomor Induk Mahasiswa">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="organization" type="text" class="form-control"
                                            placeholder="Organisasi">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="phone" type="text" class="form-control"
                                            placeholder="Nomor Telpon (Whatsapp)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-wrap">
                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                            <div class="input-container" id="date-picker-container">
                                                <label for="borrow_at_alt">Tanggal Masuk</label>
                                                <input type="date" id="borrow_at_alt" class="until_at"
                                                    name="borrow_at">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-wrap">
                                            <div class="icon"><span class="ion-md-calendar"></span></div>
                                            <div class="input-container" id="date-picker-container">
                                                <label for="until_at_alt">Tanggal Selesai</label>
                                                <input type="date" id="until_at_alt" name="until_at"
                                                    class="until_at">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group custom-file">
                                        <input type="file" class="custom-file-input form-control "
                                            id="surat_peminjaman" name="surat_peminjaman">
                                        <label class="custom-file-label" for="surat_peminjaman">Upload Surat
                                            Peminjaman</label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <input type="submit" value="Pinjam Ruang Sekarang" class="btn btn-primary">
                    </div>
                    </form>
                </div>
            </div>
        </div>


        @section('scripts')
            // ready
            <script>
                //triggered when modal is about to be shown
                $(document).on('click', '#buttonBorrowRoomModal', function() {

                    var roomName = $(this).data('room-name');
                    var roomId = $(this).data('room-id');
                    // get component room input
                    var roomInput = $('#borrowRoomModal').find('input[name="room"]')[0];
                    // set value room input
                    roomInput.value = roomId;
                    // change title modal
                    $('#borrowRoomModalLabel').text('Pinjam Ruang - ' + roomName);

                    $(document).on('click', '#buttonBorrowRoomModal', function() {
                        var roomName = $(this).data('room-name');
                        var roomId = $(this).data('room-id');
                        // get component room input
                        var roomInput = $('#borrowRoomModal').find('input[name="room"]')[0];
                        // set value room input
                        roomInput.value = roomId;

                        // set title modal
                        $('#borrowRoomModal').find('.modal-title').text('Pinjam Ruang - ' + roomName);



                    });
                });
                const dateContainers = document.querySelectorAll('.input-container');
                dateContainers.forEach(dateContainer => {
                    const dateInput = dateContainer.querySelector('input');
                    // disable from 3 days from now
                    const today = new Date();
                    today.setDate(today.getDate() + 3);
                    dateInput.min = today.toISOString().split('T')[0];


                });

                /* ----------------------------------------------------------------------------- */
                /* -- Automatically set the date for check-in (today) and checkout (tomorrow) -- */
                /* ----------------------------------------------------------------------------- */
                document.addEventListener("DOMContentLoaded", function() {
                    // get all elements id borrow_at and until_at
                    const dateCheckin = document.getElementById('borrow_at');
                    const dateCheckout = document.getElementById('until_at');

                    const modalDateCheckin = document.getElementById('borrow_at_alt');
                    const modalDateCheckout = document.getElementById('until_at_alt');

                    // set date for checkin and checkout
                    const today = new Date();

                    today.setDate(today.getDate() + 3);
                    dateCheckin.valueAsDate = today;
                    dateCheckout.valueAsDate = today;

                    modalDateCheckin.valueAsDate = today;
                    modalDateCheckout.valueAsDate = today;


                    dateCheckin.addEventListener("input", function() {
                        const checkinDate = dateCheckin.valueAsDate;
                        const checkoutDate = dateCheckout.valueAsDate;
                        // if checkin date is greater than checkout date then set checkout date to next day
                        if (checkoutDate < checkinDate) {
                            const newCheckoutDate = new Date(checkinDate);
                            newCheckoutDate.setDate(newCheckoutDate.getDate());
                            dateCheckout.valueAsDate = newCheckoutDate;
                        }

                        // set min date for checkout date to checkin date
                        dateCheckout.min = dateCheckin.value;

                    });

                    modalDateCheckin.addEventListener("input", function() {
                        const checkinDate = modalDateCheckin.valueAsDate;
                        const checkoutDate = modalDateCheckout.valueAsDate;

                        if (checkoutDate < checkinDate) {
                            const newCheckoutDate = new Date(checkinDate);
                            newCheckoutDate.setDate(newCheckoutDate.getDate());
                            modalDateCheckout.valueAsDate = newCheckoutDate;
                        }

                        // set min date for checkout date to checkin date
                        modalDateCheckout.min = modalDateCheckin.value;
                    });


                    dateCheckout.addEventListener("input", function() {
                        const checkinDate = dateCheckin.valueAsDate;
                        const checkoutDate = dateCheckout.valueAsDate;

                        if (checkoutDate < checkinDate) {
                            const newCheckinDate = new Date(checkoutDate);
                            newCheckinDate.setDate(newCheckinDate.getDate());
                            dateCheckin.valueAsDate = newCheckinDate;
                        }
                    });

                    modalDateCheckout.addEventListener("input", function() {
                        const checkinDate = modalDateCheckin.valueAsDate;
                        const checkoutDate = modalDateCheckout.valueAsDate;

                        if (checkoutDate < checkinDate) {
                            const newCheckinDate = new Date(checkoutDate);
                            newCheckinDate.setDate(newCheckinDate.getDate());
                            modalDateCheckin.valueAsDate = newCheckinDate;
                        }
                    });

                });



                // set file input
                $('#surat_peminjaman').on('change', function() {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').html(fileName);
                });


                // on modal form submit
                $('#borrowRoomModal').find('form').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var url = form.attr('action');
                    var method = form.attr('method');

                    $.ajax({
                        url: url,
                        method: method,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // reset form
                            resetBorrowRoomModalForm();
                            // close modal
                            $('#borrowRoomModal').modal('hide');
                            // show success message
                            alert(
                                'Peminjaman berhasil, silahkan cek status peminjaman di halaman admin. Masuk menggunakan username dan password adalah NIM Yang ada isi!.'
                            );
                            // redirect to admin login
                            window.location.href = "{{ route('admin.login') }}";

                        },
                        error: function(xhr, status, error) {
                            var response = xhr.responseJSON;
                            if (response.errors) {
                                alert(response.errors);
                            } else {
                                alert('Terjadi kesalahan, silahkan coba lagi.');
                            }
                        }
                    });
                });


                //
                function resetBorrowRoomModalForm() {
                    $('#borrowRoomModal').find('input[name="full_name"]').val('');
                    $('#borrowRoomModal').find('input[name="nim"]').val('');
                    $('#borrowRoomModal').find('input[name="organization"]').val('');
                    $('#borrowRoomModal').find('input[name="phone"]').val('');

                    $('#borrowRoomModal').find('input[name="borrow_at"]').val('');
                    $('#borrowRoomModal').find('input[name="until_at"]').val('');
                    $('#borrowRoomModal').find('input[name="room"]').val('');
                    $('#borrowRoomModal').find('input[name="surat_peminjaman"]').val('');

                }
            </script>

            {{-- If any error scroll to form --}}
            @if ($errors->isNotEmpty())
                <script>
                    $(document).ready(function() {
                        // Scroll only in mobile device
                        if (/Android|webOS|iPhone|iPad|Mac|Macintosh|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
                                .userAgent)) {
                            document.getElementById("form-pinjam-ruang").scrollIntoView();
                        }
                    });
                </script>
            @endif
        @endsection
    @endsection
