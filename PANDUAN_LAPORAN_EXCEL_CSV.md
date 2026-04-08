# Panduan Fitur Export Excel / CSV (Tanpa Library Eksternal)

Sama seperti fitur Cetak PDF, fitur **Download Excel** ini sengaja mengandalkan kemampuan dasar dari bahasa **Native PHP**, agar project Laravel ini tidak membengkak gara-gara package library pihak ketiga. Format jadinya akan berakhiran file **`.csv`** (Comma-Separated Values) yang bisa dibuka menggunakan Microsoft Excel.

## 1. Lokasi Kode
Jika asesor bertanya, tunjukkan method ini yang berada di **Controller Dashboard Admin**:

**File:** `app/Http/Controllers/Admin/DashboardController.php`
**Fungsi:** `exportExcel()`

## 2. Cara Kerjanya (Logic)

Berikut potongan krusial dari *source code* dan cara merangkai penjelasannya kepada asesor:

```php
// 1. Fungsi bawaan Laravel untuk memaksa trigger download ke browser
return response()->streamDownload(function () use ($orders) {
    // 2. Membuka output memori untuk menulis data di server (bukan di database)
    $file = fopen('php://output', 'w');
    
    // 3. Menulis baris pertama sebagai Header Excel
    fputcsv($file, ['Order ID', 'Tanggal Transaksi', 'Nama Pelanggan', 'Detail Item Buku', 'Total Harga (Rp)']);

    // 4. Proses Loop data transaksi
    foreach ($orders as $order) {
        $itemDetails = [];
        foreach ($order->orderItems as $item) {
            $itemDetails[] = $item->book->title . " (x" . $item->quantity . ")";
        }

        // Tulis baris isian data langsung
        fputcsv($file, [
            '#' . $order->id,
            $order->created_at->format('d/m/Y H:i'),
            $order->user->name,
            implode(', ', $itemDetails),
            $order->total_price
        ]);
    }
    
    // 5. Menutup pemrosesan file di memori
    fclose($file);
}, $filename, [    // Mengatur header agar browser mengenali ini sebagai file CSV
    'Content-Type' => 'text/csv',
    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
]);
```

## 3. Apa yang harus dijawab/diucapkan ke asesor?

> *"Pak/Bu, untuk Export Excel ini, saya tidak menggunakan library berat seperti `laravel-excel`. Saya lebih memilih mengoptimalkan fungsi dasar PHP native bernama `fputcsv` yang digabungkan dengan method `response()->streamDownload()` dari bawaan Laravel."*
>
> *"Konsep kerjanya, saya menarik data `order` sukses dari database, lalu menulis baris-baris (kolom Excel) satu per satu ke dalam sistem stream memori (`php://output`). Terakhir, saya menyesuaikan header HTTP menjadi `text/csv`."*
>
> *"Dengan konsep Stream dan tanpa Library tambahan ini, proses generate data hingga ratusan transaksi pun akan lebih cepat dan sangat ringan untuk CPU server kita, karena datanya ditulis sambil di-download, dan sama sekali tidak membuat laptop/server ngelag."*

---
Gunakan panduan ini dan file `PANDUAN_LAPORAN_PDF.md` sebagai senjata pamungkas buat kamu menjawab pertanyaan asesor besok! 🔥