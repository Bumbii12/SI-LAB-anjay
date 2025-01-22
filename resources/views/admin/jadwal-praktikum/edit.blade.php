@extends('admin.app')

@section('title', 'Edit Jadwal Praktikum')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div style="width: 100%; max-width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; background-color: #ffffff;">
        <h1 class="text-center mb-4">Edit Jadwal Praktikum</h1>

        <form action="{{ route('jadwal-praktikum.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select name="hari" class="form-select" required>
                    <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" class="form-control" value="{{ $jadwal->jam }}" required>
            </div>

            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select" required>
                    @foreach ($kelas as $kls)
                        <option value="{{ $kls->id_kelas }}" {{ $jadwal->id_kelas == $kls->id_kelas ? 'selected' : '' }}>
                            {{ $kls->nama_kelas }} - {{ $kls->mata_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <input type="text" name="ruangan" class="form-control" value="{{ $jadwal->ruangan }}" required>
            </div>

            <!-- Pilih Asisten Dosen -->
            <div class="mb-4">
                <label for="asdos-dropdown" class="form-label">Pilih Asisten Dosen</label>
                <div class="input-group">
                    <select id="asdos-dropdown" class="form-select">
                        <option value="">-- Pilih Asisten Dosen --</option>
                        @foreach ($asistens as $as)
                            <option value="{{ $as->id }}">{{ $as->nama }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="addAsdos()" class="btn btn-success">Tambah</button>
                </div>
            </div>

            <!-- Daftar Asisten Dosen yang Dipilih -->
            <div id="asdos-list" class="mb-4">
                @foreach ($jadwal->asistens as $asisten)
                    <div id="asdos-item-{{ $asisten->id }}" class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                        <span>{{ $asisten->nama }}</span>
                        <input type="hidden" name="asdos_ids[]" value="{{ $asisten->id }}">
                        <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('jadwal-praktikum.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    function addAsdos() {
        const dropdown = document.getElementById("asdos-dropdown");
        const selectedValue = dropdown.value;
        const selectedText = dropdown.options[dropdown.selectedIndex].text;

        if (!selectedValue) {
            alert("Pilih asisten dosen terlebih dahulu!");
            return;
        }

        const asdosList = document.getElementById("asdos-list");

        if (document.getElementById("asdos-item-" + selectedValue)) {
            alert("Asisten dosen sudah ditambahkan!");
            return;
        }

        const newItem = document.createElement("div");
        newItem.id = "asdos-item-" + selectedValue;
        newItem.className = "d-flex justify-content-between align-items-center p-2 border rounded mb-2";
        newItem.innerHTML = `
            <span>${selectedText}</span>
            <input type="hidden" name="asdos_ids[]" value="${selectedValue}">
            <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger btn-sm">Hapus</button>
        `;
        asdosList.appendChild(newItem);
    }
</script>
@endsection
@endsection
