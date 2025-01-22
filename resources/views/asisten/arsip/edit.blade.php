@extends('asisten.app')

@section('title', 'Edit Arsip Praktikum')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div style="width: 100%; max-width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 30px; background-color: #ffffff;">
            <h1 class="text-center mb-4">Edit Arsip Praktikum</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                    <select id="mata_kuliah" name="mata_kuliah" class="form-select" required>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->mata_proyek }}" {{ $arsip->mata_proyek == $kls->mata_proyek ? 'selected' : '' }}>
                                {{ $kls->mata_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control" value="{{ $arsip->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control">{{ $arsip->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" id="link" name="link" class="form-control" value="{{ $arsip->link }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('asisten.arsip') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
