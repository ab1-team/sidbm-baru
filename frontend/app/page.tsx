'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import api from '@/lib/api';
import Cookies from 'js-cookie';
import { IUser, ITenantInfo } from '@/lib/types';

export default function Home() {
    const [user, setUser] = useState<IUser | null>(null);
    const [loading, setLoading] = useState(true);
    const [tenantInfo, setTenantInfo] = useState<ITenantInfo | null>(null);
    const router = useRouter();

    useEffect(() => {
        const checkAuth = async () => {
            const token = Cookies.get('auth_token');
            if (!token) {
                router.push('/login');
                return;
            }

            try {
                // Get user info
                const userRes = await api.get('/me');
                setUser(userRes.data);

                // Get tenant info
                const tenantRes = await api.get('/');
                setTenantInfo(tenantRes.data);
            } catch (err) {
                console.error('Auth error:', err);
                Cookies.remove('auth_token');
                router.push('/login');
            } finally {
                setLoading(false);
            }
        };

        checkAuth();
    }, [router]);

    if (loading) {
        return (
            <div className="flex min-h-screen items-center justify-center bg-zinc-50 dark:bg-black">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-zinc-50 dark:bg-black font-sans">
            <nav className="border-b border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 px-8 py-4 flex items-center justify-between sticky top-0 z-50">
                <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/30">
                        S
                    </div>
                    <div>
                        <h1 className="text-xl font-bold text-zinc-900 dark:text-white">SIDBM Modern</h1>
                        <p className="text-xs text-zinc-500">ID Kecamatan: {tenantInfo?.tenant_id}</p>
                    </div>
                </div>

                <div className="flex items-center gap-6">
                    <div className="text-right hidden sm:block">
                        <p className="text-sm font-semibold text-zinc-900 dark:text-white">{user?.name}</p>
                        <p className="text-xs text-zinc-500 uppercase tracking-widest">{user?.role_id ? 'Staff' : 'Admin'}</p>
                    </div>
                    <button 
                        onClick={async () => {
                            try {
                                await api.post('/logout');
                            } finally {
                                Cookies.remove('auth_token');
                                router.push('/login');
                            }
                        }}
                        className="px-4 py-2 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800 text-sm font-medium transition-all"
                    >
                        Keluar
                    </button>
                </div>
            </nav>

            <main className="p-8 max-w-7xl mx-auto">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {/* Welcome Card */}
                    <div className="md:col-span-2 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-2xl shadow-blue-500/20">
                        <h2 className="text-3xl font-bold mb-2">Selamat Datang, {user?.name}!</h2>
                        <p className="text-blue-100 mb-8 opacity-80">Sistem Informasi Dana Bergulir Masyarakat (SIDBM) kini hadir dengan pengalaman yang lebih cepat dan aman.</p>
                        
                        <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-auto">
                            <div className="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                                <p className="text-xs text-blue-200 mb-1">Total Anggota</p>
                                <p className="text-2xl font-bold">-</p>
                            </div>
                            <div className="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                                <p className="text-xs text-blue-200 mb-1">Total Kelompok</p>
                                <p className="text-2xl font-bold">-</p>
                            </div>
                            <div className="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                                <p className="text-xs text-blue-200 mb-1">Total Pinjaman</p>
                                <p className="text-2xl font-bold">-</p>
                            </div>
                            <div className="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                                <p className="text-xs text-blue-200 mb-1">Total NPL</p>
                                <p className="text-2xl font-bold">0%</p>
                            </div>
                        </div>
                    </div>

                    {/* Quick Access */}
                    <div className="bg-white dark:bg-zinc-900 rounded-3xl p-8 border border-zinc-200 dark:border-zinc-800 shadow-xl">
                        <h3 className="text-lg font-bold mb-6 text-zinc-900 dark:text-white">Akses Cepat</h3>
                        <div className="space-y-3">
                            {['Data Anggota', 'Data Kelompok', 'Pengajuan Proposal', 'Laporan Keuangan'].map((item) => (
                                <button key={item} className="w-full text-left px-4 py-3 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-800 border border-transparent hover:border-zinc-200 dark:hover:border-zinc-700 transition-all text-sm text-zinc-700 dark:text-zinc-300">
                                    {item}
                                </button>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Status Section */}
                <div className="mt-12">
                    <h3 className="text-xl font-bold mb-6 text-zinc-900 dark:text-white">Status Operasional</h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        {[
                            { label: 'Koneksi API', value: 'Stabil', color: 'text-green-500' },
                            { label: 'Database Tenant', value: tenantInfo?.tenant_id || '-', color: 'text-blue-500' },
                            { label: 'Terakhir Backup', value: 'Hari ini', color: 'text-zinc-500' },
                            { label: 'Versi Sistem', value: 'v3.0.0-Headless', color: 'text-purple-500' },
                        ].map((stat) => (
                            <div key={stat.label} className="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-lg">
                                <p className="text-xs text-zinc-500 mb-1 uppercase tracking-widest">{stat.label}</p>
                                <p className={`text-lg font-bold ${stat.color}`}>{stat.value}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </main>
        </div>
    );
}
