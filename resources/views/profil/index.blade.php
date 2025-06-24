@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Profil Saya</h1>

        <div class="card shadow-sm p-4">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
        <a href="{{ route('profil.ubah') }}" class="btn btn-primary mt-3">Ubah Profil</a>
    </div>
@endsection
