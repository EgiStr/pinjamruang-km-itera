@extends('layouts.default')
@section('metas')
    <title>Ruangan | KM-ITERA </title>
    {{-- meta tags --}}
    <meta name="description" content="Daftar Ruangan KM-ITERA">
    <meta name="keywords"
        content="Daftar Ruangan, KM-ITERA, Ruang Sekre KM itera, Gedung e itera, ITERA, Institut Teknologi Sumatera, Kampus">
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
    <meta property="og:image" content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
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
    <meta name="twitter:image" content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
    <meta name="twitter:image:alt" content="Gedung Laboratorium Teknik ITERA">
    <meta name="twitter:url" content="{{ route('jadwal') }}">
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="KM-ITERA">
    <meta name="twitter:label2" content="Est. reading time">
    <meta name="twitter:data2" content="0 minutes">
    <meta name="twitter:site" content="@km_itera">
    <meta name="twitter:creator" content="@km_itera">
    <meta name="twitter:image:src" content="{{ asset('assets/Gedung-Laboratorium-Teknik-2-1-1536x864.jpg') }}">
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

    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
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
                                    class="fa fa-chevron-right"></i></a></span> <span>Ruangan <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Daftar Ruangan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters">
                @foreach ($data['rooms'] as $key => $room)
                    @php
                        $room_status = $room->status;
                        $borrower_status = [];

                        // Check if any borrow rooms
                        if ($room->borrow_rooms->isNotEmpty()) {
                            // Check each borrow_rooms
                            foreach ($room->borrow_rooms as $key => $borrow_room) {
                                // Show details if not finished yet by checking status first
                                if (
                                    $borrow_room->returned_at == null &&
                                    $borrow_room->admin_approval_status == App\Enums\ApprovalStatus::Disetujui
                                ) {
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
                                        $borrower_status[] = $borrower_first_name . ' - ' . $borrow_at->format('d M Y');
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
                                    <h3 class="mb-3"><a href="rooms.html">{{ $room->name }}</a></h3>
                                    <p class="pt-1"><a href="javascript:void(0)" id="buttonBorrowRoomModal"
                                            class="btn-custom px-3 py-2" data-toggle="modal"
                                            data-target="#borrowRoomModal" data-room-id="{{ $room->id }}"
                                            data-room-name="{{ $room->name }}">Pinjam
                                            Ruang Ini <span class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="borrowRoomModal" tabindex="-1" role="dialog" aria-labelledby="borrowRoomModalLabel"
        aria-hidden="true">
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
                                            <input type="date" id="borrow_at_alt" class="until_at" name="borrow_at">
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
                                            <input type="date" id="until_at_alt" name="until_at" class="until_at">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input form-control " id="surat_peminjaman"
                                        name="surat_peminjaman">
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
    </div>

@section('scripts')
    <script>
        //triggered when modal is about to be shown
        $(document).on('click', '#buttonBorrowRoomModal', function() {
            var roomName = $(this).data('room-name');
            var roomId = $(this).data('room-id');
            // get component room input
            var roomInput = $('#borrowRoomModal').find('input[name="room"]')[0];
            // set value room input
            roomInput.value = roomId;
            // set title modal
            $('#borrowRoomModal').find('.modal-title').text('Pinjam Ruang - ' + roomName);
            // set file input


        });
        $('#surat_peminjaman').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        const dateContainers = document.querySelectorAll('.input-container');
        dateContainers.forEach(dateContainer => {
            const dateInput = dateContainer.querySelector('input');
            // disable from 3 days from now
            const today = new Date();
            today.setDate(today.getDate() + 3);
            dateInput.min = today.toISOString().split('T')[0];
        });
        document.addEventListener("DOMContentLoaded", function() {
            const modalDateCheckin = document.getElementById('borrow_at_alt');
            const modalDateCheckout = document.getElementById('until_at_alt');

            // set date for checkin and checkout
            const today = new Date();

            today.setDate(today.getDate() + 3);

            modalDateCheckin.valueAsDate = today;
            modalDateCheckout.valueAsDate = today;

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
@endsection
@endsection
