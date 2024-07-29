<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            {{-- icon  --}}
            <img src="{{ asset('/assets/km_itera_logo.svg') }}" alt="logo Keluarga mahasiswa Insitut Teknologi Sumatera"
                style="width: 50px; height: 50px;">
            {{-- text --}}

            KM ITERA - PINJAM RUANG </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars nav-toggle-text" style="color:white "></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if (\Request::is('/')) active @endif"><a href="/"
                        class="nav-link">Beranda</a></li>
                <li class="nav-item @if (\Request::is('jadwal')) active @endif"><a href="{{ route('jadwal') }}"
                        class="nav-link">Jadwal Ruangan</a></li>
                <li class="nav-item @if (\Request::is('rooms')) active @endif"><a href="{{ route('rooms') }}"
                        class="nav-link">Daftar Ruangan</a></li>
                <li class="nav-item @if (\Request::is('sop')) active @endif"><a href="{{ route('sop') }}"
                        class="nav-link">SOP</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
