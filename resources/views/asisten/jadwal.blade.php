@extends('asisten.app')

@section('title', 'Jadwal Praktikum')

@section('content')

    <h1 class="text-center mb-4" style="color: #0446b0;">Jadwal Praktikum</h1>

    <div class="table-responsive">
        <table class="table table-bordered" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden;">
            <thead>
                <tr>
                    <th style="background-color: #0446b0; color: white; padding: 10px; text-align: center;">Hari</th>
                    <th style="background-color: #0446b0; color: white; padding: 10px; text-align: center;">Jam</th>
                    <th style="background-color: #0446b0; color: white; padding: 10px; text-align: center;">Kelas</th>
                    <th style="background-color: #0446b0; color: white; padding: 10px; text-align: center;">Ruangan</th>
                    <th style="background-color: #0446b0; color: white; padding: 10px; text-align: center;">Asisten Dosen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $jadwal)
                    <tr>
                        <td class="text-center align-middle">{{ $jadwal->hari }}</td>
                        <td class="text-center align-middle">{{ $jadwal->jam }}</td>
                        <td class="text-center align-middle">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                        <td class="text-center align-middle">{{ $jadwal->ruangan }}</td>
                        <td class="text-center align-middle">
                            <div class="d-flex flex-wrap justify-content-center">
                                @foreach ($jadwal->asistens as $asisten)
                                    <span class="badge bg-info text-dark m-1">{{ $asisten->nama }}</span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger align-middle">Tidak ada jadwal</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
