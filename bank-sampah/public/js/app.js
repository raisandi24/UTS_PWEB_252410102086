document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('mobileMenu');
    const nav = document.getElementById('mainNav');

    if (menuButton && nav) {
        menuButton.addEventListener('click', function () {
            nav.classList.toggle('open');
        });
    }

    const searchInput = document.getElementById('wasteSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const table = document.getElementById('wasteTable');
    const emptyState = document.getElementById('emptyState');

    function filterWasteRows() {
        if (!table) return;

        const keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const category = categoryFilter ? categoryFilter.value : '';
        const rows = table.querySelectorAll('tbody tr');
        let visibleCount = 0;

        rows.forEach(function (row) {
            // data-search berisi fakultas + jenis + kategori; jika tidak ada, pakai seluruh teks baris.
            const haystack = row.dataset.search || row.textContent.toLowerCase();
            const matchesText = haystack.includes(keyword);
            const matchesCategory = !category || row.dataset.category === category;
            const visible = matchesText && matchesCategory;
            row.hidden = !visible;
            if (visible) {
                visibleCount++;
                const number = row.querySelector('.row-no');
                if (number) number.textContent = visibleCount; // nomor mengikuti hasil pencarian
            }
        });

        if (emptyState) emptyState.hidden = visibleCount !== 0;
    }

    if (searchInput) searchInput.addEventListener('input', filterWasteRows);
    if (categoryFilter) categoryFilter.addEventListener('change', filterWasteRows);

    // Notifikasi "Setoran berhasil ditambahkan" hilang otomatis setelah 2,6 detik.
    const toast = document.getElementById('spToast');
    if (toast) {
        setTimeout(function () { toast.style.display = 'none'; }, 2600);
    }
});
