@extends('layouts.app')

@section('title', 'Profil | Bank Sampah Kampus')

@section('content')
<section class="page-heading">
    <div><span class="eyebrow">AKUN PENGGUNA</span><h1>Profil Saya</h1><p>Informasi akun dan ringkasan kontribusimu untuk lingkungan kampus.</p></div>
    <div class="heading-icon">♙</div>
</section>

<section class="profile-layout">
    <article class="profile-card">
        <div class="profile-cover"></div>
        <div class="profile-main">
            <div class="avatar">{{ strtoupper(substr($profile['name'], 0, 1)) }}</div>
            <h2>{{ $profile['name'] }}</h2><p>{{ $profile['role'] }} · Anggota SAMDA</p>
            <span class="member-badge">✓ Anggota aktif</span>
        </div>
        <div class="profile-stats"><div><strong>{{ $profile['points'] }}</strong><span>Total poin</span></div><div><strong>{{ $profile['deposits'] }}</strong><span>Total setoran</span></div></div>
    </article>
    <article class="detail-card">
        <div class="section-heading"><div><span class="eyebrow">INFORMASI</span><h2>Detail akun</h2></div><span class="detail-icon">▤</span></div>
        <div class="detail-list">
            <div><span>Nama pengguna</span><strong>{{ $profile['name'] }}</strong></div>
            <div><span>Email kampus</span><strong>{{ $profile['email'] }}</strong></div>
            <div><span>ID anggota</span><strong>{{ $profile['member_id'] }}</strong></div>
            <div><span>Status</span><strong class="green-text">Aktif</strong></div>
            <div><span>Bergabung sejak</span><strong>{{ $profile['joined'] }}</strong></div>
        </div>
        <p class="profile-hint">Profil ini menggunakan data contoh dan dapat dikembangkan lebih lanjut sesuai kebutuhan sistem.</p>
    </article>
</section>
@endsection
