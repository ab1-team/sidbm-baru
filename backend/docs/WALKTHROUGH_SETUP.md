# Pembangunan Ulang SIDBM: Arsitektur Modern (Headless)

Sesuai dengan `docs/MIGRATIONS.md`, sistem telah ditransformasi menjadi arsitektur **Headless Multi-Tenancy** menggunakan Laravel 13 sebagai API Backend dan Next.js 16 sebagai Frontend.

## 1. Konfigurasi Backend (Laravel API)
- **Sanctum Auth**: Terpasang untuk autentikasi berbasis token yang aman.
- **Isolasi Database**: Setiap kecamatan (tenant) memiliki database terpisah (`sidbm_tenant_x`).
- **User Management**: Tabel `users` telah dipindahkan ke tingkat tenant untuk isolasi staf kecamatan, sementara `admin_users` tetap di pusat.
- **API Endpoints**:
    - `POST /api/login`: Autentikasi user tenant.
    - `POST /api/logout`: Menghapus token akses.
    - `GET /api/me`: Mengambil data profil user yang sedang login.

## 2. Konfigurasi Frontend (Next.js)
- **Dynamic Tenant Detection**: Frontend secara otomatis mendeteksi ID kecamatan dari subdomain browser (misal: `1.sidbm.test`).
- **API Helper**: Menggunakan Axios dengan interceptor untuk menyertakan token autentikasi secara otomatis.
- **UI Premium**:
    - **Halaman Login**: Desain minimalis dan modern di `app/login/page.tsx`.
    - **Dashboard**: Layout responsif dengan status operasional real-time di `app/page.tsx`.

## 3. Cara Pengujian (Demo)
1.  **Backend**: Pastikan server berjalan di `sidbm.test` (atau `localhost:8000`).
2.  **Frontend**: Jalankan `pnpm dev` di folder `frontend`.
3.  **Akses**: Buka `http://1.sidbm.test:3000` (Gunakan subdomain untuk identifikasi tenant).
4.  **Login**:
    - **Username**: `admin`
    - **Password**: `password`

## Perubahan Penting Lainnya
- `config/cors.php`: Diperbarui untuk mengizinkan komunikasi antar-domain.
- `config/tenancy.php`: Menambahkan `sidbm.test` sebagai domain pusat.
- `database/migrations/tenant`: Menambahkan tabel `users` untuk tiap kecamatan.

---
**Sistem siap untuk dilanjutkan ke pembangunan modul-modul bisnis lainnya.**
