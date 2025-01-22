@extends ('asisten.app')

@section('title', 'Nilai')

@section('content')
    <div class="container mt-3">
        <h2>Nilai Mahasiswa</h2>
        <button id="showUploadForm" class="btn btn-dark mb-3">Upload</button>

        <!-- Upload Form Section -->
        <div id="uploadForm" class="border p-4 mb-3" style="display: none; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <form id="formUpload" enctype="multipart/form-data" method="post" action="{{ route('upload.nilai') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select id="semester" name="semester" class="form-select" style="border-radius: 10px;">
                                <option selected disabled>Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <select id="mata_kuliah" name="mata_kuliah" class="form-select" style="border-radius: 10px;">
                                <option selected disabled>Pilih Mata Kuliah</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->mata_proyek }}">{{ $kls->mata_proyek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select id="kelas" name="kelas" class="form-select" style="border-radius: 10px;">
                                <option selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->nama_kelas }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="DD/MM/YY" value="{{ now()->format('d/m/Y') }}" readonly style="border-radius: 10px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">Lampiran</label>
                            <input type="file" id="file" name="file" class="form-control" accept=".xls, .xlsx" style="border-radius: 10px;">
                            <small class="form-text text-muted">*file maks. 4MB</small>
                        </div>
                        <div id="filePreview" class="border p-2 text-center" style="height: 200px; overflow: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <span class="text-muted">PREVIEW FILE</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" id="cancelUpload" class="btn btn-secondary" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-dark" style="border-radius: 10px;">Upload</button>
                </div>
            </form>
        </div>

        <!-- Data Table Section -->
        <div class="table-responsive" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th style="background-color: #0446b0; color: white;">No</th>
                        <th style="background-color: #0446b0; color: white;">Tanggal</th>
                        <th style="background-color: #0446b0; color: white;">Mata Kuliah</th>
                        <th style="background-color: #0446b0; color: white;">Kelas</th>
                        <th style="background-color: #0446b0; color: white;">Lampiran</th>
                        <th style="background-color: #0446b0; color: white;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nilaiMahasiswa as $nilai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nilai->tanggal }}</td>
                            <td>{{ $nilai->mata_kuliah }}</td>
                            <td>{{ $nilai->kelas }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $nilai->lampiran) }}" target="_blank" class="btn btn-link">Download</a>
                            </td>
                            <td>
                                <a href="{{ route('edit.nilai', $nilai->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('delete.nilai', $nilai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No entry data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <footer class="text-center mt-4 py-3">
        <p class="text-muted mb-0">&copy; 2024 Hak Cipta Dilindungi [TIM PPL]</p>
    </footer>
    <!-- Script for form visibility and file preview -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show upload form when clicking 'Upload' button
            $('#showUploadForm').click(function() {
                $('#uploadForm').show();
            });

            // Hide upload form when clicking 'Batal'
            $('#cancelUpload').click(function() {
                $('#uploadForm').hide();
            });

            // Display selected file name in preview area
            $('#file').change(function(event) {
                let file = event.target.files[0];
                if (file) {
                    $('#filePreview').html('<p>' + file.name + '</p>');
                } else {
                    $('#filePreview').html('<span class="text-muted">PREVIEW FILE</span>');
                }
            });
        });
    </script>
@endsection
