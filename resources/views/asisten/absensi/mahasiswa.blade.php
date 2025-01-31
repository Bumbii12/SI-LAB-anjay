@extends("asisten.app")

@section("title", "Absensi Mahasiswa")

@section("content")
    <div class="container">
        <h1 class="mb-5">Absensi Mahasiswa</h1>

        <!-- Notifications -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Daftar Kelas -->
        <div class="list-group">
            @forelse ($kelasList as $kelas)
                <div
                    class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row gap-4 rounded bg-white p-3 shadow-lg">
                    <span class="fw-bold">{{ $kelas->nama_kelas }}</span>

                    <!-- Dropdown Button -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle shadow-sm" type="button"
                                id="dropdownMenuButton{{ $kelas->id_kelas }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilihan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $kelas->id_kelas }}">
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route("asisten.absensi.mahasiswaDetail", ["id_kelas" => $kelas->id_kelas]) }}">
                                    Lihat Absensi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#">
                                    Hapus Kelas (Fitur Belum Aktif)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">Anda tidak memiliki kelas untuk dikelola.</div>
            @endforelse
        </div>
    </div>
@endsection
