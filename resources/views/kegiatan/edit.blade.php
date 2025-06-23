@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kegiatan</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kegiatan</label>
                <input type="text" name="nama" id="nama" class="form-control"
                    value="{{ old('nama', $kegiatan->nama) }}">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Tag:</label><br>
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ isset($kegiatan) && $kegiatan->tags->contains($tag->id) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    value="{{ old('tanggal', $kegiatan->tanggal) }}">
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label><br>
                @if ($kegiatan->gambar)
                    <img src="{{ asset('uploads/' . $kegiatan->gambar) }}" alt="Gambar Kegiatan" width="100"><br>
                @endif
                <input type="file" name="gambar" id="gambar" class="form-control mt-2">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
