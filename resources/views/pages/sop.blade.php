{{-- show page for show pdf  --}}
@extends('layouts.default')
@section('metas')
    <title>Standar Operasional Prosedur | KM-ITERA </title>
    {{-- meta tags --}}
    <meta name="description" content="Standar Operasional Prosedur Peminjaman ruang KM-ITERA">
    <meta name="keywords" content="Standar Operasional Prosedur, SOP, KM-ITERA, Ruang Sekre KM itera, Gedung e itera">
    <meta name="author" content="KM-ITERA">
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Standar Operasional Prosedur</h3>
                <iframe src="{{ asset('assets/SOP_PEMINJAMAN_RUANGAN_DAN_BARANG_KM_ITERA_2024.pdf') }}" width="100%"
                    height="800px"></iframe>
            </div>
        </div>
    </div>
@endsection
