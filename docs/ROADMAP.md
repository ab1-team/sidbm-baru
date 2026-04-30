# SIDBM Modernization Roadmap 🚀

Dokumen ini melacak kemajuan pembangunan ulang SIDBM menggunakan arsitektur **Headless (Laravel API + Next.js)**.

## 🟢 Fase 1: Setup Arsitektur & Multi-Tenancy
*Fokus: Membangun pondasi sistem yang stabil dan terisolasi.*
- [x] Setup Laravel 13 API Backend
- [x] Konfigurasi `stancl/tenancy` (Isolasi Database per Kecamatan)
- [x] Integrasi Laravel Sanctum (Autentikasi API)
- [x] Setup Next.js 16 Frontend dengan App Router
- [x] Implementasi Dynamic Tenant Identification di Frontend
- [x] Halaman Login & Dashboard Utama (Premium UI)

## 🟡 Fase 2: Migrasi Data & Schema Master
*Fokus: Memindahkan data dari sistem legacy ke struktur database baru.*
- [/] Pembersihan Data Legacy (Cleaning & Formatting)
- [/] Automasi Migrasi Tenant (Script `migrate:legacy`)
- [x] Implementasi Module Master: **Data Anggota** (CRUD + UI)
- [ ] Implementasi Module Master: **Data Kelompok** (CRUD + UI)
- [ ] Implementasi Module Master: **Data Desa & Kecamatan**

## 🔵 Fase 3: Siklus Pinjaman (Core Business)
*Fokus: Mengimplementasikan logika bisnis utama dana bergulir.*
- [ ] Pengajuan & Proposal Pinjaman
- [ ] Sistem Verifikasi & Kelayakan (Scoring)
- [ ] Proses Dropping (Pencairan Dana)
- [ ] Manajemen Angsuran & Penjadwalan Otomatis
- [ ] Penanganan Pelunasan & Penghapusan Piutang

## 🔴 Fase 4: Akuntansi & Keuangan
*Fokus: Memastikan integritas data keuangan dan laporan.*
- [ ] Jurnal Umum Otomatis (Triggered by Transactions)
- [ ] Buku Besar (General Ledger)
- [ ] Laporan Neraca & Laba Rugi (Real-time)
- [ ] Laporan Arus Kas (Cash Flow)
- [ ] Fitur Tutup Buku & Alokasi Laba Tahunan

## 🟣 Fase 5: Monitoring & Reporting Premium
*Fokus: Memberikan nilai tambah bagi pengelola melalui data visual.*
- [ ] Dashboard Statistik (Chart.js / Recharts)
- [ ] Monitoring NPL & Kolektibilitas (Aging Schedule)
- [ ] Export Laporan (PDF & Excel)
- [ ] Sistem Notifikasi (WA/Email) untuk Tunggakan
- [ ] Konsolidasi Data Laporan per Kabupaten

---

## 📅 Log Pembaruan Terakhir:
- **2026-04-30**: Implementasi penuh Modul Master Anggota (API & UI Premium).
- **2026-04-30**: Inisialisasi arsitektur Headless, integrasi Sanctum, dan pembuatan UI Dashboard awal.

> [!NOTE]
> Roadmap ini bersifat fleksibel dan dapat berubah sesuai dengan kebutuhan pengembangan dan masukan dari pengguna.
