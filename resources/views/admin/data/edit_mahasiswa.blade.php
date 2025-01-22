@extends('admin.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container mt-3 d-flex justify-content-center">
    <div style="width: 100%; max-width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; background-color: #ffffff;">
        <h1 class="text-center mb-4">Edit Data Mahasiswa</h1>

        <form action="{{ route('data.mahasiswas.update', $mahasiswa->npm) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="npm" class="form-label">NPM</label>
                    <input type="text" class="form-control" id="npm" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kelas_id[]" class="form-label">Kelas</label>
                    <select class="form-select" name="kelas_id[]" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" 
                                @foreach($mahasiswa->kelas as $mk)
                                    {{ $mk->id_kelas == $k->id_kelas ? 'selected' : '' }}
                                @endforeach
                            >
                                {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="kelas-container"></div>

            <div class="mt-4 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-success" id="add-kelas-button">Tambah Kelas</button>
                <a href="{{ route('data.mahasiswas.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-kelas-button').addEventListener('click', function() {
        // Temukan container untuk input kelas
        const kelasContainer = document.getElementById('kelas-container');
        const newField = document.createElement('div'); // Buat elemen baru untuk input
        newField.classList.add('row', 'mb-3');
        newField.innerHTML = `
            <div class="col-md-10">
                <label for="kelas_id[]" class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id[]" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm w-100 remove-kelas-button">Hapus</button>
            </div>
        `;

        // Tambahkan elemen baru ke dalam container
        kelasContainer.appendChild(newField);

        // Tambahkan event listener untuk tombol hapus
        newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
            newField.remove();
        });
    });
</script>
@endsection
