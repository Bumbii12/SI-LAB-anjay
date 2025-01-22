@extends('admin.app')

@section('title', 'Arsip Praktikum (Admin)')

@section('content')
    <div class="container">
        <h1>Arsip Praktikum (Admin)</h1>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Arsip -->
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
            <table class="table table-striped mt-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; width: 100%; max-width: 1200px;">
                <thead>
                    <tr>
                        <th style="background-color: #0446b0; color: #fff;">No</th>
                        <th style="background-color: #0446b0; color: #fff;">Mata Kuliah</th>
                        <th style="background-color: #0446b0; color: #fff;">Judul</th>
                        <th style="background-color: #0446b0; color: #fff;">Deskripsi</th>
                        <th style="background-color: #0446b0; color: #fff;">Lampiran</th>
                        <th style="background-color: #0446b0; color: #fff;">Actions</th>
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
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $arsip->mata_proyek }}</td>
                                <td>{{ $arsip->judul }}</td>
                                <td>{{ $arsip->deskripsi }}</td>
                                <td><a href="{{ $arsip->link }}" target="_blank">View Link</a></td>
                                <td>
                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
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

           <!-- Pagination -->
           <div class="d-flex justify-content-between align-items-center mt-4">
            <!-- Left: Showing X to Y of Z results -->
            <div>
                <p class="text-muted mb-0">
                    Showing {{ $arsipPraks->firstItem() }} to {{ $arsipPraks->lastItem() }} of {{ $arsipPraks->total() }} results
                </p>
            </div>
            <!-- Right: Pagination -->
            <div>
                {{ $arsipPraks->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <style>
        .pagination {
            margin-bottom: 0;
        }
    </style>
@endsection

