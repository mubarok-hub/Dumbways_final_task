@extends('layouts.app')

@section('content')
    <div class="container dflex justify-content-center">
        <h1 class="justify-content-center">Daftar Kegiatan</h1>
        <a href="{{ route('kegiatan.create') }}" class="justify-content-center">Tambah Kegiatan</a>

        <form action="{{ route('kegiatan.index') }}" method="GET">
            <input type="text" name="search" placeholder="Cari nama Kegiatan" value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>

        <div class="d-flex justify-content-center mt-1">
            {{ $kegiatan->links('pagination::bootstrap-4') }}
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Tags</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kegiatan as $item)
                    {{-- perulangan data dengan pengecekan kosong --}}
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>
                            @if ($item->gambar)
                                <img src="{{ asset('uploads/' . $item->gambar) }}" alt="Gambar" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            @forelse ($item->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->nama }}</span>
                            @empty
                                <span class="text-muted">-</span>
                            @endforelse
                        </td>
                        <td>
                            @can('update', $item)
                                {{-- untuk pengecekan ijin pengguna berdasarkan policy --}}
                                <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan

                            @can('delete', $item)
                                <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    {{-- Biasanya digunakan bersama @forelse, tapi bisa juga berdiri sendiri buat ngecek apakah sebuah variabel kosong --}}
                    <tr>
                        <td colspan="6" class="text-center">Belum ada kegiatan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-1">
        {{ $kegiatan->links('pagination::bootstrap-4') }}
    </div>
@endsection
