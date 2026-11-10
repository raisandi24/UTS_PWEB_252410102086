@extends('layouts.app')

@section('title', 'Pengelolaan Setoran | Bank Sampah Kampus')

@section('content')
<section class="page-heading">
    <div><span class="eyebrow">DATA BANK SAMPAH</span><h1>Pengelolaan Setoran Sampah</h1><p>Catat dan pantau setoran sampah dari seluruh fakultas kampus.</p></div>
    <span class="sp-pill">● Sistem aktif</span>
</section>

<section class="management-summary setoran-stats">
    <div><span>TOTAL SETORAN</span><strong>{{ $totalCount }}</strong><small>Transaksi tercatat</small></div>
    <div><span>TOTAL BERAT SAMPAH</span><strong>{{ $totalWeight }} kg</strong><small>Akumulasi seluruh fakultas</small></div>
    <div><span>FAKULTAS BERPARTISIPASI</span><strong>{{ $facultyCount }}</strong><small>Fakultas yang menyetorkan sampah</small></div>
</section>

<section class="sp-panel">
    <div class="sp-head">
        <div><h2>＋ Tambah Setoran Sampah</h2><div class="sp-hint">Isi data fakultas dan sampah yang disetorkan.</div></div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('pengelolaan.store') }}" method="POST" id="setoranForm">
        @csrf
        <input type="hidden" name="username" value="{{ $username }}">
        <div class="sp-grid">
            <div class="sp-field">
                <label for="faculty">Fakultas penyetor</label>
                <input id="faculty" name="faculty" type="text" maxlength="80" placeholder="Contoh: Fakultas Ilmu Komputer" value="{{ old('faculty') }}" required>
            </div>
            <div class="sp-field">
                <label for="kind">Jenis sampah</label>
                <input id="kind" name="kind" type="text" maxlength="60" placeholder="Contoh: Botol plastik" value="{{ old('kind') }}" required>
            </div>
            <div class="sp-field">
                <label for="category">Kategori sampah</label>
                <input id="category" name="category" type="text" maxlength="40" placeholder="Contoh: Plastik" value="{{ old('category') }}" required>
            </div>
            <div class="sp-field">
                <label for="weight">Berat setoran (kg)</label>
                <input id="weight" name="weight" type="number" min="0.01" step="0.01" placeholder="Contoh: 5" value="{{ old('weight') }}" required>
            </div>
            <div class="sp-field">
                <label for="date">Tanggal setoran</label>
                <input id="date" name="date" type="date" value="{{ old('date', $today) }}" required>
            </div>
        </div>
        <div class="sp-actions">
            <button class="btn btn-primary" type="submit">Simpan Setoran <span>→</span></button>
        </div>
        @if (session('success'))
            <div class="sp-toast" id="spToast" role="status">{{ session('success') }}</div>
        @endif
    </form>
</section>

<section class="sp-panel">
    <div class="sp-head">
        <div><h2>Daftar Setoran Sampah</h2><div class="sp-hint">Daftar fakultas yang telah menyetorkan sampah ke bank sampah.</div></div>
        <div class="sp-toolbar"><input class="sp-search" id="wasteSearch" type="search" placeholder="Cari fakultas atau sampah..."></div>
    </div>
    <div class="table-responsive">
        <table id="wasteTable">
            <thead><tr><th>NO.</th><th>FAKULTAS PENYETOR</th><th>JENIS SAMPAH</th><th>KATEGORI</th><th>BERAT</th><th>TANGGAL SETOR</th></tr></thead>
            <tbody>
            @foreach ($deposits as $deposit)
                <tr data-search="{{ mb_strtolower($deposit['faculty'] . ' ' . $deposit['kind'] . ' ' . $deposit['category']) }}">
                    <td class="row-no">{{ $loop->iteration }}</td>
                    <td class="sp-faculty">{{ $deposit['faculty'] }}</td>
                    <td>{{ $deposit['kind'] }}</td>
                    <td><span class="sp-tag">{{ $deposit['category'] }}</span></td>
                    <td class="sp-weight">{{ $deposit['weight_label'] }}</td>
                    <td>{{ $deposit['date_label'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="emptyState" class="empty-state" hidden>Data tidak ditemukan.</div>
    <div class="sp-footnote">* Data setoran pada halaman ini bersifat simulasi dan disimpan di session Laravel (tanpa tabel database). Data kembali ke contoh awal jika session berakhir.</div>
</section>
@endsection
