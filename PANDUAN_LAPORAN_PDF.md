# Panduan Fitur Cetak Laporan PDF (Tanpa Library)

Dokumen ini dibuat khusus untuk membantu kamu mengingat dan menjelaskan cara kerja fitur **"Download Laporan Penjualan"** kepada asesor saat ujian/asesmen.

---

## 1. Konsep Dasar (Kenapa Tidak Pakai Library?)
Fitur ini sengaja **tidak menggunakan library eksternal** (seperti DomPDF) dengan alasan:
1. **Performa Server Lebih Ringan:** Server tidak perlu bekerja keras mengubah HTML menjadi file PDF.
2. **Menghindari Error / Lag:** Terkadang instalasi library PDF menyebabkan *Internal Server Error* atau lag yang parah.
3. **Memanfaatkan Fitur Bawaan Browser:** Hampir semua browser modern (Chrome, Edge, Firefox) sudah punya fitur "Save as PDF" bawaan yang jauh lebih cepat dan rapi.

---

## 2. Lokasi Kode dan Penjelasannya

Jika asesor bertanya *"Mana kodingannya dan bagaimana alurnya?"*, tunjukkan 3 file ini secara berurutan:

### A. Tombol di Halaman Dashboard
**File:** `resources/views/admin/dashboard.blade.php`
**Kode:**
```html
<a href="{{ route('admin.report.pdf') }}" target="_blank" class="...">
    Download Laporan PDF
</a>
```
**Penjelasan ke Asesor:** 
> "Ini adalah tombol pemantiknya. Saya menggunakan `target="_blank"` agar ketika tombol diklik, halaman laporan terbuka di tab baru, sehingga halaman dashboard admin tidak tertutup."

### B. Proses Pengambilan Data di Controller
**File:** `app/Http/Controllers/Admin/DashboardController.php`
**Fungsi:** `printPDF()`
**Kode:**
```php
public function printPDF()
{
    // 1. Mengambil data transaksi yang berstatus 'delivered' atau 'completed'
    $orders = Order::with('user', 'orderItems.book')
        ->whereIn('status', ['delivered', 'completed'])
        ->latest()
        ->get();

    // 2. Menghitung total uang (Pendapatan)
    $totalRevenue = $orders->sum('total_price');
    
    // 3. Menghitung total jumlah buku yang terjual
    $totalBooksSold = $orders->sum(function ($order) {
        return $order->orderItems->sum('quantity');
    });

    // 4. Mengirim data tersebut ke file View (Tampilan)
    return view('admin.report.pdf', compact('orders', 'totalRevenue', 'totalBooksSold'));
}
```
**Penjelasan ke Asesor:** 
> "Di Controller ini, saya membuat *query* ke database untuk mengambil pesanan penjualan yang sudah sukses saja. Lalu, saya menggunakan collection Laravel (`sum`) untuk menghitung total pendapatan dan total buku yang terjual, kemudian melempar (*passing*) datanya ke View."

### C. Tampilan View & Trik Cetak (Bagian Paling Penting!)
**File:** `resources/views/admin/report/pdf.blade.php`

Tunjukkan 2 blok kode ini:

**Trik 1: Menyembunyikan Tombol dengan CSS Media Query**
```css
@media print {
    .no-print {
        display: none !important;
    }
}
```
**Penjelasan ke Asesor:**
> "Bagian CSS ini adalah intinya. Saya menggunakan `@media print`. Ketika browser mendeteksi bahwa halaman ini sedang mau dicetak (atau di-save ke PDF), semua elemen HTML yang memiliki class `no-print` (misal: tombol 'Kembali') akan otomatis disembunyikan. Jadi, hasil PDF-nya tetap bersih dan terlihat seperti dokumen laporan resmi."

**Trik 2: Pop-up Print Otomatis menggunakan JavaScript**
```javascript
<script>
    window.onload = function() {
        window.print();
    }
</script>
```
**Penjelasan ke Asesor:**
> "Untuk memudahkan admin, saya menambahkan script `window.print()` yang dibungkus oleh event `window.onload`. Artinya, begitu halaman laporan ini selesai memuat data, script akan memaksa browser untuk langsung memunculkan Jendela Print secara otomatis. Admin tinggal mengganti *Destination* print menjadi 'Save as PDF'."

---

## 3. Kesimpulan Penutup untuk Asesor

Jika disuruh menyimpulkan, cukup bacakan ini:
> *"Jadi Pak/Bu, dibanding menggunakan library pihak ketiga yang membebani server, saya lebih memilih mengakali render PDF menggunakan fitur bawaan browser. Menggabungkan CSS `@media print` untuk merapikan layout cetak, dan `window.print()` untuk memanggil fungsi cetaknya secara otomatis. Pendekatan ini lebih hemat memori, aman dari bug, dan *loading*-nya instan."*

Semoga sukses asesmennya besok, Coo! 🔥