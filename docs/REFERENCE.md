# Referensi Sistem & Aplikasi SIDBM 📚

Dokumen ini mencatat detail aplikasi dan database yang digunakan sebagai referensi dalam proses pembangunan ulang sistem SIDBM Modern.

## 1. Aplikasi Sumber (Legacy)
Aplikasi utama yang sedang diperbarui fungsinya:
- **Lokasi Proyek**: `F:\Workspace\laragon\www\sidbm`
- **Deskripsi**: Sistem manajemen dana bergulir berbasis web (Legacy) yang menangani transaksi harian di tingkat kecamatan.
- **Tujuan Update**: Migrasi total ke arsitektur Headless (Laravel API + Next.js) untuk performa, keamanan, dan skalabilitas yang lebih baik.

## 2. Database Sumber (Legacy)
Database pusat yang menampung data operasional dari sistem lama:
- **Host**: `103.177.95.90` (Remote Database)
- **Database Name**: `dbm_laravel`
- **Karakteristik Data**: 
    - Penamaan kolom masih menggunakan format variatif (banyak `snake_case` tapi tidak standar).
    - Memiliki ribuan data anggota dan puluhan ribu riwayat transaksi.
    - Struktur saldo bulanan (pivoting diperlukan untuk migrasi ke struktur tahunan).

## 3. Aplikasi Referensi Logika (BUMDesmart)
Digunakan sebagai patokan untuk beberapa modul spesifik:
- **Lokasi Proyek**: `F:\Workspace\laragon\www\bumdesmart`
- **Modul Referensi**:
    - **Arus Kas (Cash Flow)**: Digunakan sebagai standar perhitungan aliran dana masuk dan keluar.
    - **Accounting Logic**: Pola penjurnalan otomatis untuk transaksi retail/koperasi.
    - **Note**: Tidak ada referensi UI/Layout dari BUMDesmart. Tampilan sepenuhnya baru (Pure Tailwind).

## 4. Pemetaan Modul (Mapping)
| Modul Legacy           | Implementasi Baru (Modern)                     | Status          |
| :--------------------- | :--------------------------------------------- | :-------------- |
| Dashboard Statis       | Real-time Dashboard (Next.js + Chart.js)       | Planned         |
| Transaksi Terpusat     | Multi-Tenancy (Isolated DB per Kecamatan)      | **Done**        |
| Pengelolaan Anggota    | Headless CRUD (Pure Tailwind UI)               | In Progress     |
| Laporan Manual         | Dynamic PDF & Excel Engine (Server Side)       | Planned         |

---

> [!IMPORTANT]
> Setiap perubahan logika yang signifikan pada sistem baru harus divalidasi terhadap data asli di `dbm_laravel` untuk menjaga integritas saldo dan riwayat pinjaman anggota.
