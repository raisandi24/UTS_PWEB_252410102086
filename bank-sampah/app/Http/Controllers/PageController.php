<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:40'],
        ]);

        // Simulasi login tanpa database. Username diteruskan melalui query parameter.
        return redirect()->route('dashboard', [
            'username' => $request->input('username'),
        ]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username', 'Mahasiswa');

        $summary = [
            ['label' => 'Sampah terkumpul', 'value' => '248 kg', 'icon' => '♻', 'tone' => 'green'],
            ['label' => 'Nasabah aktif', 'value' => '86 orang', 'icon' => '♙', 'tone' => 'blue'],
            ['label' => 'Poin terkumpul', 'value' => '12.450', 'icon' => '★', 'tone' => 'orange'],
            ['label' => 'Setoran bulan ini', 'value' => '32 transaksi', 'icon' => '▤', 'tone' => 'purple'],
        ];

        $activities = [
            ['name' => 'Kertas HVS', 'category' => 'Kertas', 'weight' => '8,5 kg', 'date' => '10 Nov 2026', 'status' => 'Diterima'],
            ['name' => 'Botol PET', 'category' => 'Plastik', 'weight' => '4 kg', 'date' => '09 Nov 2026', 'status' => 'Diterima'],
            ['name' => 'Kardus', 'category' => 'Kertas', 'weight' => '12 kg', 'date' => '08 Nov 2026', 'status' => 'Diproses'],
        ];

        return view('dashboard', compact('username', 'summary', 'activities'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username', 'Mahasiswa');

        // Data setoran disimpan di session (bukan database). Jika session kosong,
        // dipakai data contoh awal.
        $deposits = $request->session()->get('setoran', $this->defaultDeposits());

        $totalCount = count($deposits);
        $totalWeight = $this->formatNumber(array_sum(array_column($deposits, 'weight')));
        $facultyCount = count(array_unique(array_map('mb_strtolower', array_column($deposits, 'faculty'))));

        // Siapkan label tampilan (berat & tanggal) untuk @foreach di View.
        $deposits = array_map(function (array $row) {
            $row['weight_label'] = $this->formatNumber($row['weight']) . ' kg';
            $row['date_label'] = $this->formatDate($row['date']);

            return $row;
        }, $deposits);

        $today = now()->toDateString();

        return view('pengelolaan', compact(
            'username', 'deposits', 'totalCount', 'totalWeight',
            'facultyCount', 'today'
        ));
    }

    public function storeSetoran(Request $request)
    {
        $validated = $request->validate([
            'username' => ['nullable', 'string', 'max:40'],
            'faculty' => ['required', 'string', 'max:80'],
            'kind' => ['required', 'string', 'max:60'],
            'category' => ['required', 'string', 'max:40'],
            'weight' => ['required', 'numeric', 'min:0.01', 'max:100000'],
            'date' => ['required', 'date_format:Y-m-d'],
        ], [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute harus berupa angka.',
            'weight.min' => 'Berat setoran minimal 0,01 kg.',
            'date_format' => 'Format :attribute tidak valid.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute terlalu panjang atau terlalu besar.',
        ], [
            'faculty' => 'Fakultas penyetor',
            'kind' => 'Jenis sampah',
            'category' => 'Kategori sampah',
            'weight' => 'Berat setoran',
            'date' => 'Tanggal setoran',
        ]);

        $deposits = $request->session()->get('setoran', $this->defaultDeposits());

        // Setoran terbaru ditaruh paling atas.
        array_unshift($deposits, [
            'faculty' => $validated['faculty'],
            'kind' => $validated['kind'],
            'category' => $validated['category'],
            'weight' => round((float) $validated['weight'], 2),
            'date' => $validated['date'],
        ]);

        $request->session()->put('setoran', $deposits);

        return redirect()
            ->route('pengelolaan', ['username' => $validated['username'] ?? 'Mahasiswa'])
            ->with('success', 'Setoran berhasil ditambahkan ke daftar.');
    }

    public function profile(Request $request)
    {
        $username = $request->query('username', 'Mahasiswa');
        $profile = [
            'name' => $username,
            'email' => strtolower(str_replace(' ', '.', $username)) . '@kampus.ac.id',
            'role' => 'Mahasiswa',
            'member_id' => 'BSK-2026-0086',
            'joined' => 'September 2026',
            'points' => '1.250',
            'deposits' => '8 kali',
        ];

        return view('profile', compact('username', 'profile'));
    }

    /** Data contoh awal setoran (sama seperti preview HTML). */
    private function defaultDeposits(): array
    {
        return [
            ['faculty' => 'Fakultas Ilmu Komputer', 'kind' => 'Botol plastik', 'category' => 'Plastik', 'weight' => 12.5, 'date' => '2026-11-10'],
            ['faculty' => 'Fakultas Pertanian', 'kind' => 'Kertas HVS', 'category' => 'Kertas', 'weight' => 8.0, 'date' => '2026-11-09'],
            ['faculty' => 'Fakultas Teknik', 'kind' => 'Kardus', 'category' => 'Kertas', 'weight' => 15.0, 'date' => '2026-11-08'],
            ['faculty' => 'Fakultas Ekonomi dan Bisnis', 'kind' => 'Kaleng aluminium', 'category' => 'Logam', 'weight' => 5.0, 'date' => '2026-11-07'],
        ];
    }

    /** Format angka gaya Indonesia, maksimal 2 desimal (40,5 / 12,5 / 8). */
    private function formatNumber(float|int $number): string
    {
        $text = number_format((float) $number, 2, ',', '.');

        return rtrim(rtrim($text, '0'), ',');
    }

    /** Ubah 2026-11-10 menjadi "10 Nov 2026". */
    private function formatDate(string $date): string
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $time = strtotime($date);

        return date('d', $time) . ' ' . $months[(int) date('n', $time) - 1] . ' ' . date('Y', $time);
    }
}
