@extends('admin.app')

@section('title', 'Jadwal Praktikum')

@section('content')
<div class="container mt-4" style="display: flex; flex-direction: column;">
    <h1>Jadwal Praktikum</h1>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success shadow" style="width: 100%;">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah Jadwal -->
    <div style="margin-bottom: 10px; display: flex; justify-content: flex-start;">
        <button class="btn shadow" style="background-color: #21ded8; color: white;" onclick="toggleForm()">Tambah Jadwal</button>
    </div>

    <!-- Form Tambah Jadwal -->
    <div id="form-container" class="border p-4 rounded shadow" style="display: none; border-radius: 10px;">
        <form action="{{ route('jadwal-praktikum.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select name="hari" class="form-select shadow" required>
                    <option value="">-- Pilih Hari --</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" class="form-control shadow" required>
            </div>

            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select shadow" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelas as $kls)
                        <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }} - {{ $kls->mata_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <input type="text" name="ruangan" class="form-control shadow" required>
            </div>

            <!-- Pilih Asisten Dosen -->
            <div class="mb-4">
                <label for="asdos-dropdown" class="form-label">Pilih Asisten Dosen</label>
                <div class="input-group shadow">
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
            <div id="asdos-list" class="mb-4"></div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn shadow me-2" style="background-color: #dbd9d9;" onclick="toggleForm()">Batal</button>
                <button type="submit" class="btn shadow" style="background-color: #6a0dad; color: white;">Simpan</button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Jadwal -->
    <div class="table-responsive shadow" style="width: 100%; border-radius: 10px; margin-top: 20px;">
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th style="background-color: #0446b0; color: white;">Hari</th>
                    <th style="background-color: #0446b0; color: white;">Jam</th>
                    <th style="background-color: #0446b0; color: white;">Kelas</th>
                    <th style="background-color: #0446b0; color: white;">Ruangan</th>
                    <th style="background-color: #0446b0; color: white;">Asisten Dosen</th>
                    <th style="background-color: #0446b0; color: white;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($jadwals->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data jadwal praktikum</td>
                    </tr>
                @else
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->jam }}</td>
                            <td>{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $jadwal->ruangan }}</td>
                            <td>
                                @foreach ($jadwal->asistens as $as)
                                    <span class="badge"  style="background-color: #96f5f9; color: #000;text-shadow: none ">{{ $as->nama }}</span><br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('jadwal-praktikum.edit', $jadwal->id) }}" class="btn btn-warning btn-sm shadow">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('jadwal-praktikum.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Left: Showing X to Y of Z results -->
        <div>
            <p class="text-muted mb-0">
                Showing {{ $jadwals->firstItem() }} to {{ $jadwals->lastItem() }} of {{ $jadwals->total() }} results
            </p>
        </div>
        <!-- Right: Pagination -->
        <div>
            {{ $jadwals->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
<footer class="text-center mt-4 py-3">
    <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
</footer>
<script>
    function toggleForm() {
        var form = document.getElementById("form-container");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }

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
        newItem.className = "d-flex justify-content-between align-items-center p-2 border rounded shadow mb-2";
        newItem.innerHTML = `
            <span>${selectedText}</span>
            <input type="hidden" name="asdos_ids[]" value="${selectedValue}">
            <button type="button" onclick="this.parentNode.remove()" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus
            </button>
        `;
        asdosList.appendChild(newItem);
    }
</script>

<!-- Include Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<style>
    .pagination {
        margin-bottom: 0;
    }
</style>
@endsection
