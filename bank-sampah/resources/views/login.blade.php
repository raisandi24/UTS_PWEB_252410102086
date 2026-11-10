@extends('layouts.app')

@section('title', 'Masuk | Bank Sampah Kampus')

@section('content')
<section class="login-wrap">
    <div class="login-visual">
        <div class="visual-brand"><span class="brand-mark">♻</span> SAMDA</div>
        <div class="visual-copy">
            <span class="eyebrow light">GERAKAN KAMPUS HIJAU</span>
            <h1>Langkah kecil hari ini, dampak besar untuk bumi.</h1>
            <p>Kelola sampah, kumpulkan poin, dan jadikan kampus lebih bersih bersama.</p>
        </div>
        <div class="visual-bottom"><span>●</span> Pilah • Setor • Daur ulang</div>
        <div class="decor-circle circle-one"></div><div class="decor-circle circle-two"></div>
    </div>
    <div class="login-panel">
        <div class="mobile-brand"><span class="brand-mark">♻</span> SAMDA</div>
        <div class="login-heading">
            <span class="eyebrow">SELAMAT DATANG</span>
            <h2>Masuk ke akun</h2>
            <p>Gunakan nama pengguna untuk melanjutkan ke sistem Bank Sampah Kampus.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="login-form">
            @csrf
            <label for="username">Nama pengguna</label>
            <div class="input-wrap"><span>♙</span><input id="username" name="username" type="text" placeholder="Contoh: Raihan" value="{{ old('username') }}" required maxlength="40"></div>
            <label for="password">Kata sandi <span class="muted">(simulasi)</span></label>
            <div class="input-wrap"><span>⌑</span><input id="password" name="password" type="password" placeholder="Masukkan kata sandi" value="kampushijau" disabled></div>
            <button class="btn btn-primary btn-full" type="submit">Masuk ke Dashboard <span>→</span></button>
        </form>
        <p class="login-note">Demo UTS Pemrograman Web · Tidak menggunakan database.</p>
    </div>
</section>
@endsection
