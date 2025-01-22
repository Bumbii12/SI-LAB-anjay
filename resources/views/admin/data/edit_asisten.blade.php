@extends('admin.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; background-color: #ffffff;">
        <h2 class="text-center mb-4">Edit Asisten</h2>

        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form id="editAsistenForm" action="{{ route('asistens.update', $asisten->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" name="npm" class="form-control" value="{{ $asisten->npm }}" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $asisten->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="kelas_id[]" class="form-select" multiple required>
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id_kelas }}" 
                            @if(in_array($kelasItem->id_kelas, $asisten->kelas->pluck('id_kelas')->toArray())) selected @endif>
                            {{ $kelasItem->nama_kelas }} - {{ $kelasItem->mata_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $asisten->user->email ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('data.asistens.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">
                    Update
                </button>
            </div>

            <!-- Modal for confirmation -->
            <div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmUpdateModalLabel">Konfirmasi Perubahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin memperbarui data asisten ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="editAsistenForm" class="btn btn-primary">Ya, Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
