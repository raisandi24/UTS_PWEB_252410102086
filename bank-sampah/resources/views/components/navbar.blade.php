@props(['username' => 'Mahasiswa'])

<header class="topbar">
    <div class="topbar-inner">
        <a href="{{ route('dashboard', ['username' => $username]) }}" class="brand"><span class="brand-mark">♻</span><span>SAMDA<small>BANK SAMPAH KAMPUS</small></span></a>
        <button class="mobile-menu" id="mobileMenu" aria-label="Buka navigasi">☰</button>
        <nav class="main-nav" id="mainNav">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="{{ request()->routeIs('pengelolaan') ? 'active' : '' }}">Pengelolaan</a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profil</a>
        </nav>
        <div class="top-user"><span class="user-avatar">{{ strtoupper(substr($username, 0, 1)) }}</span><span>{{ $username }}</span><a href="{{ route('login') }}" title="Keluar" class="logout-link">↪</a></div>
    </div>
</header>
