@extends ('asisten.app')

@section('title', 'Dashboard Asisten')

@section('content')
    <!-- Membuat header dengan teks dan tanggal dalam satu baris -->
    <div class="d-flex justify-content-between align-items-center mb-4 position-relative">
        <!-- Teks Selamat Datang -->
        <h2 class="mb-0">Selamat Datang, {{ $user->name }}</h2>
        
        <!-- Dropdown Tanggal di kanan -->
        <div class="dropdown position-absolute" style="top: 0; right: 0;">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="mdi mdi-calendar"></i> Today ({{ \Carbon\Carbon::today()->format('d M Y') }})
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
            </div>
        </div>
    </div>

    <!-- Card Info Pengguna -->
    <div class="card p-3 mb-4" style="width: 300px;">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <p>Nama : {{ $user->name }}</p>
                <p>No. Hp : {{ $user->no_hp }}</p>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="rounded-circle border border-dark overflow-hidden" style="width: 120px; height: 120px;">
                    <img src="{{ asset('uploads/photos/' . $user->photo) }}" 
                         alt="User Photo" 
                         class="img-fluid" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            
            
        </div>
    </div>

    <!-- Kode Template dan Card Lainnya -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('images/people.svg') }}" alt="people"> <!-- Path gambar diperbarui -->
                </div>
            </div>
        </div>
        
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Absen Mahasiswa</p>
                            <a href="{{ route('asisten.absensi.mahasiswa') }}">See Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Absensi Asisten</p>
                            
                            <a href="{{ route('absensi.create') }}">See Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Mata Kuliah Praktikum</p>
                            
                            <a href="{{ route('jadwal-praktikum.index') }}">See Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Ruangan Praktikum</p>
                            
                            <a href="{{ route('jadwal-praktikum.index') }}">See Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection