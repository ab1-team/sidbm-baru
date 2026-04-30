# Master Plan Modernisasi SIDBM: Laravel API + Next.js + Tailwind CSS

Dokumen ini adalah panduan tunggal dan lengkap yang menggabungkan hasil analisis mendalam sistem lama serta rencana implementasi sistem baru untuk aplikasi SIDBM.

---

## 1. ANALISIS SISTEM LAMA (LEGACY)

### A. Arsitektur & Teknologi

- **Framework:** Laravel 10 (PHP 8.1+), Blade, jQuery, DataTables.
- **Multi-Tenancy:** _Table Sharding_ (Tabel dinamis dengan suffix `_lokasi`). Ini adalah hutang teknis terbesar yang menghambat migrasi dan skalabilitas.
- **Logika Bisnis:** Terkonsentrasi di dalam "Fat Controllers" (misal: `TransaksiController` ~2800 baris) dan Utility Class (`Keuangan.php`).

### B. Entitas & Logika Kunci

- **Pinjaman:** Mendukung sistem Flat dan Sliding (Menurun) dengan pembulatan otomatis.
- **Akuntansi:** Chart of Accounts (COA) 4 level, sistem jurnal ganda, dan proses tutup buku (profit allocation) yang kompleks.
- **Integrasi:** WhatsApp Gateway untuk notifikasi transaksi.

---

## 2. SPESIFIKASI TEKNOLOGI BARU

- **Backend:** Laravel 11+ (REST API Mode).
- **Frontend:** Next.js (App Router) + React.
- **Styling:** Tailwind CSS (dengan library komponen seperti Shadcn/UI).
- **Multi-Tenancy:** `stancl/tenancy` (Laravel Multi-tenancy Package).
- **Otentikasi:** Laravel Sanctum (Token-based).
- **State Management:** TanStack Query (React Query).

---

## 3. RENCANA IMPLEMENTASI (STRATEGI MIGRASI)

### A. Backend & Database (Laravel)

1.  **Inisialisasi `stancl/tenancy`:**
    - Konfigurasi pendeteksian tenant (via Subdomain atau Header `X-Tenant`).
    - Implementasi isolasi data (Multi-database atau Single-database scoped).
2.  **Membangun API First:**
    - Membuat **API Resources** untuk standarisasi output JSON.
    - Implementasi **Service Layer** & **Action Classes** untuk memindahkan logika dari Controller lama.
3.  **Migrasi Data:**
    - Membuat script migrasi untuk menarik data dari tabel-tabel sharding lama (`transaksi_1`, `transaksi_2`, dst) ke struktur database modern yang dikelola `stancl/tenancy`.

### B. Frontend (Next.js + Tailwind CSS)

1.  **Desain UI Premium:**
    - Membangun Dashboard yang responsif dan interaktif.
    - Visualisasi data keuangan menggunakan grafik (Chart.js/Recharts).
2.  **Manajemen State:**
    - Sinkronisasi data real-time dengan backend.
    - Form validation menggunakan `react-hook-form` dan `zod`.
3.  **Dokumen Dinamis:**
    - Pembuatan PDF SPK dan Kartu Angsuran langsung di sisi server (Next.js) atau melalui API Laravel yang dioptimalkan.

---

## 4. DAFTAR MODUL UNTUK DIBANGUN ULANG

| Modul               | Deskripsi Teknis                                                   |
| :------------------ | :----------------------------------------------------------------- |
| **Auth & Tenancy**  | Registrasi tenant baru, login user, pemilihan lokasi.              |
| **Database Master** | Pengelolaan Desa, Kelompok, Anggota, dan Pengelola.                |
| **Siklus Pinjaman** | Flow lengkap: Proposal → Verifikasi → Dropping → Angsuran → Lunas. |
| **Akuntansi Core**  | Jurnal Umum, Buku Besar, Neraca, Laba Rugi, dan Arus Kas.          |
| **Tutup Buku**      | Automasi alokasi laba tahunan dan pembagian dividen desa.          |
| **Monitoring NPL**  | Laporan kolektibilitas dan peringatan tunggakan via WA.            |

---

## 5. ROADMAP PENGEMBANGAN (ESTIMASI)

- **Minggu 1:** Setup Arsitektur (Laravel API, Next.js, Stancl Tenancy).
- **Minggu 2:** Migrasi Schema Database & Data Existing.
- **Minggu 3-4:** Pembangunan API Core & Service Finansial.
- **Minggu 5-6:** Pembangunan Frontend (Next.js) & Integrasi UI.
- **Minggu 7:** Testing Laporan Keuangan & Konsolidasi.
- **Minggu 8:** Deployment & Training.

---

## 6. VERIFIKASI & VALIDASI

- **Integritas Data:** Memastikan saldo akhir di sistem lama sama dengan saldo awal di sistem baru.
- **Keamanan:** Audit token Sanctum dan kebijakan CORS.
- **Performa:** Optimasi query pada database tenant yang besar.

---

**Dokumen ini adalah satu-satunya referensi yang Anda butuhkan untuk memulai proses pembangunan ulang SIDBM. Semua logika dari sistem lama telah dipetakan untuk diimplementasikan ke dalam teknologi baru.**
