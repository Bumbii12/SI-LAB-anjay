@extends('admin.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container mt-3" style="display: flex; flex-direction: column;">
        <h1>Data Mahasiswa</h1>

        @if (session('success'))
            <div class="alert alert-success shadow" style="width: 100%;">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger shadow" style="width: 100%;">{{ session('error') }}</div>
        @endif

        <div style="margin-bottom: 10px; display: flex; justify-content: flex-start; gap: 10px; align-items: flex-end;">
            <!-- Tombol Tambah -->
            <button class="btn btn-dark shadow" type="button" data-bs-toggle="collapse"
                    data-bs-target="#formTambahMahasiswa" aria-expanded="false" aria-controls="formTambahMahasiswa">
                Tambah
            </button>
        
            <!-- Tombol Export -->
            <a href="{{ route('data.mahasiswas.export') }}" class="btn btn-success w-auto">
                Export 
            </a>
        
            <!-- Form Import -->
            <form action="{{ route('data.mahasiswas.import') }}" method="POST" enctype="multipart/form-data"
                  class="d-flex flex-column p-2 bg-light shadow-sm rounded" style="max-width: 200px; min-width: 180px;">
                @csrf
                <div class="mb-2">
                    <label for="file" class="form-label fs-6" style="font-size: 10px; margin-bottom: 5px;">Pilih File Excel</label>
                    <input type="file" class="form-control form-control-sm" name="file" id="file" required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Import</button>
            </form>
        </div>
        
    <div class="collapse" id="formTambahMahasiswa" style="width: 100%;">
        <div class="card mb-3 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <h5 class="card-title">Form Tambah Mahasiswa</h5>
                <form action="{{ route('data.mahasiswas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control shadow" id="npm" name="npm" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control shadow" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control shadow" id="no_hp" name="no_hp" required>
                    </div>
                    <div id="kelas-container">
                        <div class="mb-3">
                            <label for="kelas_id[]" class="form-label">Kelas</label>
                            <select class="form-select shadow" name="kelas_id[]" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id_kelas }}">
                                        {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success mt-2 shadow" id="add-kelas-button">Tambah
                        Kelas</button>

                    <button type="submit" class="btn btn-primary shadow">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive shadow" style="width: 100%; border-radius: 10px;">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th style="background-color: #0446b0; color: white;">No</th>
                    <th style="background-color: #0446b0; color: white;"><a href="{{ route('data.mahasiswas.index', ['sort' => request('sort') == 'npm_asc' ? 'npm_desc' : 'npm_asc']) }}" 
                        style="text-decoration: none; color: white;">
                         NPM
                         @if(request('sort') == 'npm_asc')
                             <i class="fas fa-sort-up"></i>
                         @elseif(request('sort') == 'npm_desc')
                             <i class="fas fa-sort-down"></i>
                         @else
                             <i class="fas fa-sort"></i>
                         @endif
                     </a></th>
                    <th style="background-color: #0446b0; color: white;">Nama Lengkap</th>
                    <th style="background-color: #0446b0; color: white;">No. HP</th>
                    <th style="background-color: #0446b0; color: white;">Kelas</th>
                    <th style="background-color: #0446b0; color: white;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $index => $mhs)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mhs->npm }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->no_hp }}</td>
                        <td>
                            @foreach ($mhs->kelas as $k)
                                <span class="badge"
                                    style="background-color: #96f5f9; color: #000;text-shadow: none ">{{ $k->nama_kelas }}
                                    ({{ $k->mata_proyek }})
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('data.mahasiswas.edit', $mhs->npm) }}" class="btn btn-warning btn-sm shadow">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('data.mahasiswas.destroy', $mhs->npm) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Left: Showing X to Y of Z results -->
        <div>
            <p class="text-muted mb-0">
                Showing {{ $mahasiswa->firstItem() }} to {{ $mahasiswa->lastItem() }} of {{ $mahasiswa->total() }}
                results
            </p>
        </div>
        <!-- Right: Pagination -->
        <div>
            {{ $mahasiswa->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>

    <footer class="text-center mt-4 py-3">
        <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
    </footer>

    <script>
        document.getElementById('add-kelas-button').addEventListener('click', function() {
            const kelasContainer = document.getElementById('kelas-container');
            const newField = document.createElement('div');
            newField.classList.add('mb-3');
            newField.innerHTML = `
            <label for="kelas_id[]" class="form-label">Kelas</label>
            <select class="form-select shadow" name="kelas_id[]" required>
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id_kelas }}">
                        {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm mt-2 remove-kelas-button shadow">Hapus</button>
        `;
            kelasContainer.appendChild(newField);

            newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
                newField.remove();
            });
        });
    </script>

    <style>
        .pagination {
            margin-bottom: 0;
        }
    </style>
@endsection
