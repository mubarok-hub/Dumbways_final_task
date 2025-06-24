@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <h5>Selamat datang {{ Auth::user()->name }}!</h5>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body text-center">
                        <h1 class="display-3">{{ $totalKegiatan }}</h1>
                        <div>
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-primary">Kelola Kegiatan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
