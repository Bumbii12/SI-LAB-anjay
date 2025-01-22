@extends('asisten.app')

@section('title', 'Arsip Praktikum')

@section('content')
    <div class="container">
        <h1>Arsip Praktikum</h1>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah Data -->
        <button id="addButton" class="btn btn-primary">Add</button>

        <!-- Form Tambah Data -->
        <div id="formContainer" class="mt-4" style="display: none;">
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <form id="arsipForm" method="POST" action="{{ route('arsip.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <select id="mata_kuliah" name="mata_kuliah" class="form-select rounded-3" required>
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->mata_proyek }}">{{ $kls->mata_proyek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" id="judul" name="judul" class="form-control rounded-3" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control rounded-3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" id="link" name="link" class="form-control rounded-3">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" id="cancelButton" class="btn btn-secondary me-2 rounded-3">Batal</button>
                            <button type="submit" class="btn btn-success rounded-3">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Data Arsip -->
        <table class="table table-striped mt-4" style="border-collapse: collapse; width: 100%; border: none; border-radius: 20px;">
            <thead>
                <tr>
                    <th style="background-color: #0446b0; border-top-left-radius: 20px; border-right: 2px solid #ddd; padding: 10px;">No</th>
                    <th style="background-color: #0446b0; border-right: 2px solid #ddd; padding: 10px;">Mata Kuliah</th>
                    <th style="background-color: #0446b0; border-right: 2px solid #ddd; padding: 10px;">Judul</th>
                    <th style="background-color: #0446b0; border-right: 2px solid #ddd; padding: 10px;">Deskripsi</th>
                    <th style="background-color: #0446b0; border-right: 2px solid #ddd; padding: 10px;">Lampiran</th>
                    <th style="background-color: #0446b0; border-top-right-radius: 20px; padding: 10px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($arsipPraks->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-danger">No Entry Data</td>
                    </tr>
                @else
                    @foreach ($arsipPraks as $index => $arsip)
                        <tr>
                            <td style="border-right: 2px solid #ddd; padding: 10px;">{{ $index + 1 }}</td>
                            <td style="border-right: 2px solid #ddd; padding: 10px;">{{ $arsip->mata_proyek }}</td>
                            <td style="border-right: 2px solid #ddd; padding: 10px;">{{ $arsip->judul }}</td>
                            <td style="border-right: 2px solid #ddd; padding: 10px;">{{ $arsip->deskripsi }}</td>
                            <td style="border-right: 2px solid #ddd; padding: 10px;">
                                <a href="{{ $arsip->link }}" target="_blank" class="btn btn-link">View Link</a>
                            </td>
                            <td style="padding: 10px;">
                                <!-- Tombol Edit -->
                                <a href="{{ route('arsip.edit', $arsip->id) }}" class="btn btn-warning btn-sm rounded-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Tombol Delete -->
                                <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-3">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <footer class="text-center mt-4 py-3">
        <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
    </footer>
    <!-- Script untuk Toggle Form -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const addButton = document.getElementById('addButton');
        const formContainer = document.getElementById('formContainer');
        const cancelButton = document.getElementById('cancelButton');

        addButton.addEventListener('click', () => {
            formContainer.style.display = 'block';
        });

        cancelButton.addEventListener('click', () => {
            formContainer.style.display = 'none';
        });
    </script>
@endsection
