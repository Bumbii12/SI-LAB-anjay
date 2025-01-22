@extends('asisten.app')

@section('title', 'Absensi Mahasiswa')

@section('content')
    <div class="container">
        <h1 class="mb-5">Absensi Mahasiswa</h1>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs d-flex justify-content-start mb-4" style="gap: 10px;">
            <li class="nav-item">
                <a class="nav-link active tab-layout" data-bs-toggle="tab" href="#ganjil" role="tab">Ganjil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-layout" data-bs-toggle="tab" href="#genap" role="tab">Genap</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- Ganjil Tab -->
            <div id="ganjil" class="tab-pane fade show active">
                @foreach ($proyekGanjil as $namaProyek => $proyekItems)
                    <div class="list-group mb-3">
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-white shadow-lg p-3 rounded flex-column flex-md-row gap-4">
                            <span class="fw-bold">{{ $namaProyek }}</span>

                            <!-- Dropdown Button -->
                            <div class="dropdown">
                                <button class="btn btn-layout dropdown-toggle shadow-sm" type="button" id="dropdownMenuButton{{ $namaProyek }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kelas
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $namaProyek }}">
                                    @foreach ($proyekItems as $kelas)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('asisten.absensi.mahasiswaDetail', ['id_kelas' => $kelas->id_kelas]) }}">
                                                {{ $kelas->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Genap Tab -->
            <div id="genap" class="tab-pane fade">
                @foreach ($proyekGenap as $namaProyek => $proyekItems)
                    <div class="list-group mb-3">
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-white shadow-lg p-3 rounded flex-column flex-md-row gap-4">
                            <span class="fw-bold">{{ $namaProyek }}</span>

                            <!-- Dropdown Button -->
                            <div class="dropdown">
                                <button class="btn btn-layout dropdown-toggle shadow-sm" type="button" id="dropdownMenuButton{{ $namaProyek }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kelas
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $namaProyek }}">
                                    @foreach ($proyekItems as $kelas)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('asisten.absensi.mahasiswaDetail', ['id_kelas' => $kelas->id_kelas]) }}">
                                                {{ $kelas->nama_kelas }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
