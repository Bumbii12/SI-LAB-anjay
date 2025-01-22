@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h3>Hasil Absensi Mahasiswa - {{ $kelas->nama_kelas }}</h3>

    <!-- Tabel Hasil Absensi -->
    <div class="table-responsive shadow" style="width: 100%; border-radius: 10px;">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th style="background-color: #0446b0; color: white;">No</th>
                    <th style="background-color: #0446b0; color: white;">NPM</th>
                    <th style="background-color: #0446b0; color: white;">Nama Mahasiswa</th>
                    <th style="background-color: #0446b0; color: white;">Jumlah Kehadiran</th>
                    <th style="background-color: #0446b0; color: white;">Total Pertemuan</th>
                    <th style="background-color: #0446b0; color: white;">Presentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekapAbsensi as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data['npm'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['kehadiran'] }}</td>
                        <td>{{ $data['totalPertemuan'] }}</td>
                        <td>{{ $data['persentase'] }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
            
        </table>
        
    </div>

    <!-- Total Kehadiran -->
<div class="mt-4 shadow p-3 rounded" style="background-color: #f7f7f7; border-radius: 10px;">
    <h5>Total Kehadiran: 
        <span class="text-primary">{{ $totalKehadiran }}</span> / 
        <span class="text-secondary">{{ $totalPertemuan * count($rekapAbsensi) }}</span>
    </h5>
    <h5>Presentase Kehadiran: 
        <span class="text-success">
            @if ($totalPertemuan > 0 && count($rekapAbsensi) > 0)
                {{ number_format(($totalKehadiran / ($totalPertemuan * count($rekapAbsensi))) * 100, 2) }}%
            @else
                0%
            @endif
        </span>
    </h5>
</div>
</div>
<footer class="text-center mt-4 py-3">
    <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
</footer>
@endsection