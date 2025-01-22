@extends('admin.app')

@section('content')
  <div class="container mt-4">
    <h1 class="text-center mb-4">Rekap Absensi Asisten</h1>

    <!-- Tabel Rekap Absensi Asisten -->
    <div class="table-responsive shadow" style="width: 100%; border-radius: 10px;">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th style="background-color: #0446b0; color: white;">No</th>
                    <th style="background-color: #0446b0; color: white;">Nama</th>
                    <th style="background-color: #0446b0; color: white;">NPM</th>
                    <th style="background-color: #0446b0; color: white;">Kelas</th>
                    <th style="background-color: #0446b0; color: white;">Foto</th>
                    <th style="background-color: #0446b0; color: white;">Jumlah Hadir</th>
                    <th style="background-color: #0446b0; color: white;">Presentase (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapAbsensi as $index => $rekap)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $rekap['nama'] }}</td>
                        <td>{{ $rekap['npm'] }}</td>
                        <td>{{ $rekap['kelas'] }}</td>
                        <td>
                            @if (!empty($rekap['foto']) && file_exists(public_path('storage/' . $rekap['foto'])))
                            <img src="{{ asset('storage/' . $rekap['foto']) }}" alt="Foto Asisten" 
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 0;" class="shadow-sm">                       
                            @else
                                <span class="text-muted">Tidak Ada Foto</span>
                            @endif
                        </td>
                        <td>{{ $rekap['jumlah_hadir'] }}</td>
                        <td class="text-success">{{ $rekap['presentase'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


