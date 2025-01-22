@extends('asisten.app')

@section('title', 'Absensi Asisten')

@section('content')
    <div class="container d-flex justify-content-center" style="min-height: 100vh; padding: 0; align-items: flex-start;">
        <div class="card shadow p-4" style="max-width: 1000px; width: 100%; border-radius: 15px;">
            <h1 class="text-center mb-4">Absensi Asisten Dosen</h1>
            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tanggal" class="form-label fs-4">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control form-control-lg" id="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label fs-4">Kelas</label>
                    <select name="kelas" id="kelas" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ old('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} - {{ $k->mata_proyek }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="npm" class="form-label fs-4">NPM</label>
                    <input type="text" name="npm" class="form-control form-control-lg" id="npm" value="{{ old('npm') }}" required>
                    @error('npm')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label fs-4">Nama</label>
                    <input type="text" name="nama" class="form-control form-control-lg" id="nama" value="{{ old('nama', session('nama_asisten', '')) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fs-4">Foto</label>
                    <input type="file" name="foto" class="form-control form-control-lg" id="foto" accept=".jpg,.jpeg,.png">
                    @error('foto')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark w-100 btn-lg">SEND</button>
            </form>
        </div>
    </div>
    <footer class="text-center mt-4 py-3">
        <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('npm').addEventListener('input', function() {
            const npm = this.value;

            if (npm.length >= 5) {
                fetch(`/asisten/nama?npm=${npm}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nama) {
                            document.getElementById('nama').value = data.nama;
                        } else {
                            document.getElementById('nama').value = '';
                        }
                    })
                    .catch(error => console.error('Error fetching name:', error));
            } else {
                document.getElementById('nama').value = '';
            }
        });
    </script>
@endsection
