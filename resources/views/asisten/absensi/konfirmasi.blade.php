@extends('asisten.app')

@section('title', 'Absensi Mahasiswa')

@section('content')
<div class="container">
    <h1>Detail Absensi</h1>
    <h2>{{ $kelas->mata_proyek }} - {{ $kelas->nama_kelas }}</h2>
    
    <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
        <div class="p-2 text-center bg-light border rounded">
            <h5>Jumlah Hadir</h5>
            <p>{{ $totalHadir }}</p>
        </div>
        <div class="p-2 text-center bg-light border rounded">
            <h5>Jumlah Sakit</h5>
            <p>{{ $totalSakit }}</p>
        </div>
        <div class="p-2 text-center bg-light border rounded">
            <h5>Jumlah Izin</h5>
            <p>{{ $totalIzin }}</p>
        </div>
        <div class="p-2 text-center bg-light border rounded">
            <h5>Jumlah Alpa</h5>
            <p>{{ $totalAlpa }}</p>
        </div>
    </div>

    <form action="{{ route('asisten.absensi.mahasiswa.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tanggal" value="{{ request()->input('tanggal') }}">
        <input type="hidden" name="pertemuan" value="{{ request()->input('pertemuan') }}">
        <input type="hidden" name="id_kelas" value="{{ request()->input('id_kelas') }}">
        
        @foreach ($absensiData as $data)
            <input type="hidden" name="npm[]" value="{{ $data['npm'] }}">
            <input type="hidden" name="keterangan[{{ $data['npm'] }}]" value="{{ $data['keterangan'] }}">
        @endforeach

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
    </form>
</div>
@endsection