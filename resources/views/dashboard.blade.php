@extends('layouts.app')

@section('content')
    <div class="container dashboard-container">
        <h1>Dashboard</h1>
        <h5>Selamat datang, {{ Auth::user()->name }}!</h5>

        {{-- Kartu Statistik --}}
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Kegiatan</h5>
                        <h1 class="display-4">{{ $totalKegiatan }}</h1>
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-light btn-sm mt-2">Kelola</a>
                    </div>
                </div>
            </div>
        </div>`
        {{-- Tips Manajemen Waktu --}}
        <div class="card mt-4">
            <div class="card-header">Tips Manajemen Waktu</div>
            <div class="card-body">
                <p>✅ Mulailah hari dengan membuat to-do list.</p>
                <p>⏱ Fokus pada tugas paling penting terlebih dahulu.</p>
                <p>❌ Hindari multitasking berlebihan agar lebih produktif.</p>
            </div>
        </div>
        {{-- Fitur Mendatang --}}
        <div class="card mt-4">
            <div class="card-header">Fitur Mendatang</div>
            <div class="card-body">
                <ul>
                    <li>🔔 Notifikasi kegiatan via email</li>
                    <li>📊 Statistik mingguan aktivitas</li>
                    <li>📄 Export laporan ke PDF</li>
                    <li>📅 Kalender interaktif</li>
                </ul>
            </div>
        </div>

        {{-- Motivasi --}}
        <div class="text-center mt-5 mb-4 text-muted">
            <em>"Satu langkah kecil hari ini bisa jadi lompatan besar di masa depan."</em>
        </div>
    </div>
@endsection
