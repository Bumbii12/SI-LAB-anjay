@extends ('asisten.app')

@section('title', 'Edit Nilai')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div style="width: 100%; max-width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; background-color: #ffffff;">
            <h2 class="text-center mb-4">Edit Nilai Mahasiswa</h2>
            <form method="POST" action="{{ route('update.nilai', $nilai->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select id="semester" name="semester" class="form-select">
                                <option disabled>Pilih Semester</option>
                                <option value="1" {{ $nilai->semester == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $nilai->semester == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $nilai->semester == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $nilai->semester == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $nilai->semester == '5' ? 'selected' : '' }}>5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                            <select id="mata_kuliah" name="mata_kuliah" class="form-select">
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->mata_proyek }}" {{ $nilai->mata_kuliah == $kls->mata_proyek ? 'selected' : '' }}>{{ $kls->mata_proyek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select id="kelas" name="kelas" class="form-select">
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->nama_kelas }}" {{ $nilai->kelas == $kls->nama_kelas ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control" value="{{ \Carbon\Carbon::parse($nilai->tanggal)->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file" class="form-label">Lampiran (Opsional)</label>
                            <input type="file" id="file" name="file" class="form-control" accept=".xls, .xlsx">
                            <small class="form-text text-muted">*Kosongkan jika tidak ingin mengubah file</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
