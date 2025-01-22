@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h3>Absensi Mahasiswa</h3>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#ganjil">Semester Ganjil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#genap">Semester Genap</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div id="ganjil" class="tab-pane fade show active">
            @foreach ($proyekGanjil as $namaProyek => $proyekItems)
                <div class="list-group mt-3">
                    <div class="list-group-item bg-items">
                        <strong>{{ $namaProyek }}</strong>
                        <div class="dropdown float-end">
                            <button class="btn btn-layout dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Pilih Kelas
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($proyekItems as $kelas)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.rekap.absensi', ['id_kelas' => $kelas->id_kelas]) }}">
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

        <div id="genap" class="tab-pane fade">
            @foreach ($proyekGenap as $namaProyek => $proyekItems)
                <div class="list-group mt-3">
                    <div class="list-group-item bg-items">
                        <strong>{{ $namaProyek }}</strong>
                        <div class="dropdown float-end">
                            <button class="btn btn-layout dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Pilih Kelas
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($proyekItems as $kelas)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.rekap.absensi', ['id_kelas' => $kelas->id_kelas]) }}">
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