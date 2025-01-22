@extends ('admin.app')

@section('title', 'Data Asisten')

@section('content')
    <div class="container mt-3">
        <h1 class="mb-4">Data Asisten</h1>

        @if (session('success'))
            <div class="alert alert-success shadow" style="width: 100%;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger shadow" style="width: 100%;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Button Tambah Asisten -->
        <div class="mb-3">
            <button class="btn shadow" style="background-color: #21ded8; color: white;" type="button"
                data-bs-toggle="collapse" data-bs-target="#formTambahAsisten" aria-expanded="false"
                aria-controls="formTambahAsisten">
                Tambah
            </button>
        </div>

        <!-- Form Tambah Asisten -->
        <div class="collapse" id="formTambahAsisten">
            <div class="card mb-3 shadow" style="border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Asisten</h5>
                    <form action="{{ route('data.asistens.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- NPM -->
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <select name="npm" class="form-select shadow" id="npm" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->npm }}">{{ $mhs->npm }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control shadow" id="nama"
                                placeholder="Nama Asisten" required>
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" name="photo" class="form-control shadow" id="photo"
                                accept="image/*">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control shadow" placeholder="Email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group shadow">
                                <input type="password" name="password" class="form-control" placeholder="Password" required
                                    id="password-field">
                                <button type="button" class="btn btn-outline-secondary" id="toggle-password">👁️</button>
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div id="kelas-container">
                            <div class="mb-3">
                                <label for="kelas_id[]" class="form-label">Kelas</label>
                                <select class="form-select shadow" name="kelas_id[]" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Tambah Kelas -->
                        <button type="button" class="btn btn-success mt-2 shadow" id="add-kelas-button">Tambah
                            Kelas</button>

                        <!-- Tombol Simpan & Batal -->
                        <button type="submit" class="btn shadow"
                            style="background-color: #6a0dad; color: white;">Simpan</button>
                        <button type="button" class="btn shadow" style="background-color: #dbd9d9;"
                            data-bs-toggle="collapse" data-bs-target="#formTambahAsisten"
                            aria-expanded="false">Batal</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Data Asisten -->
        <div class="table-responsive shadow mb-4" style="border-radius: 10px;">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="background-color: #0446b0; color: white;">No</th>
                        <th style="background-color: #0446b0; color: white;">Foto</th>
                        <th style="background-color: #0446b0; color: white;">NPM</th>
                        <th style="background-color: #0446b0; color: white;">Nama Lengkap</th>
                        <th style="background-color: #0446b0; color: white;">No. HP</th>
                        <th style="background-color: #0446b0; color: white;">Kelas</th>
                        <th style="background-color: #0446b0; color: white;">Ket</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistens as $index => $asisten)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($asisten->photo)
                                    <img src="{{ asset('uploads/photos/' . $asisten->photo) }}" alt="{{ $asisten->nama }}"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <span>Tidak ada foto tersedia</span>
                                @endif
                            </td>
                            <td>{{ $asisten->npm }}</td>
                            <td>{{ $asisten->nama }}</td>
                            <td>{{ $asisten->mahasiswa->no_hp }}</td>
                            <td>
                                @foreach ($asisten->kelas as $k)
                                    <span class="badge"
                                        style="background-color: #96f5f9; color: #000;text-shadow: none ">{{ $k->nama_kelas }}
                                        ({{ $k->mata_proyek }})
                                    </span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <a href="{{ route('asistens.edit', $asisten->id) }}"
                                    class="btn btn-warning btn-sm shadow">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('asistens.destroy', $asisten->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                    Showing {{ $asistens->firstItem() }} to {{ $asistens->lastItem() }} of {{ $asistens->total() }}
                    results
                </p>
            </div>
            <!-- Right: Pagination -->
            <div>
                {{ $asistens->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-4 py-3">
        <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
    </footer>

    <!-- Script -->
    <script>
        const kelasData = @json($kelas);

        document.getElementById('add-kelas-button').addEventListener('click', function() {
                    const kelasContainer = document.getElementById('kelas-container');
                    const newField = document.createElement('div');
                    newField.classList.add('mb-3');
                    newField.innerHTML = ` 
                <label for="kelas_id[]" class="form-label">Kelas</label>
                <select class="form-select shadow" name="kelas_id[]" required>
                    <option value="">Pilih Kelas</option>
                    ${kelasData.map(kelas => `
                                    <option value="${kelas.id_kelas}">
                                        ${kelas.nama_kelas} - ${kelas.mata_proyek}
                                    </option>
                                `).join('')}
                </select>
                <button type="button" class="btn btn-danger btn-sm mt-2 shadow remove-kelas-button">Hapus</button>
            `;
                    kelasContainer.appendChild(newField);

                    newField.querySelector('.remove-kelas-button').addEventListener('click', function() {
                        newField.remove();

                    });

                    $('#toggle-password').click(function() {
                        const passwordField = $('#password-field');
                        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                        passwordField.attr('type', type);
                    });
    </script>


    <style>
        .pagination {
            margin-bottom: 0;
        }
    </style>
@endsection
