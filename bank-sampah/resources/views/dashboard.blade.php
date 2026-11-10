@extends('layouts.app')

@section('title', 'Dashboard | Bank Sampah Kampus')

@section('content')
<section class="welcome-row">
    <div><span class="eyebrow">SELASA, 10 NOVEMBER 2026</span><h1>Halo, {{ $username }}! <span class="wave">✦</span></h1><p>Terima kasih sudah menjadi bagian dari kampus yang lebih hijau.</p></div>
    <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="btn btn-primary">Lihat data sampah <span>→</span></a>
</section>

<section class="hero-card">
    <div class="hero-content"><span class="eyebrow light">SAMDA · SISTEM BANK SAMPAH KAMPUS</span><h2>Sampahmu punya nilai.<br>Mulai pilah dari sekarang.</h2><p>Setiap sampah yang dipilah adalah kontribusi nyata untuk lingkungan kampus.</p><a class="btn btn-white" href="{{ route('pengelolaan', ['username' => $username]) }}">Jelajahi pengelolaan <span>→</span></a></div>
    <div class="hero-art"><div class="art-ring"></div><div class="art-leaf">♻</div><span class="art-caption">CAMPUS<br>GOES GREEN</span></div>
</section>

<section class="section-block">
    <div class="section-heading"><div><span class="eyebrow">RINGKASAN</span><h2>Aktivitas bank sampah</h2></div><span class="period-pill">Per November 2026</span></div>
    <div class="stats-grid">
        @foreach ($summary as $item)
        <article class="stat-card"><div class="stat-icon {{ $item['tone'] }}">{{ $item['icon'] }}</div><div><p>{{ $item['label'] }}</p><h3>{{ $item['value'] }}</h3></div><span class="stat-trend">↗</span></article>
        @endforeach
    </div>
</section>

<section class="section-block">
    <div class="section-heading"><div><span class="eyebrow">PEMANTAUAN</span><h2>Setoran terbaru</h2></div><a class="text-link" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat semua <span>→</span></a></div>
    <div class="table-card">
        <div class="table-responsive"><table><thead><tr><th>Jenis sampah</th><th>Kategori</th><th>Berat</th><th>Tanggal</th><th>Status</th></tr></thead><tbody>
        @foreach ($activities as $activity)
        <tr><td class="table-strong">{{ $activity['name'] }}</td><td>{{ $activity['category'] }}</td><td>{{ $activity['weight'] }}</td><td>{{ $activity['date'] }}</td><td><span class="status {{ $activity['status'] === 'Diterima' ? 'status-green' : 'status-yellow' }}">{{ $activity['status'] }}</span></td></tr>
        @endforeach
        </tbody></table></div>
    </div>
</section>
@endsection
