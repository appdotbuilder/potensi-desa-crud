import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface DashboardStats {
    total_users?: number;
    total_desa?: number;
    total_umkm?: number;
    total_penduduk?: number;
    desa_name?: string;
    total_fasilitas?: number;
    total_sekolah?: number;
    total_kesehatan?: number;
    total_pariwisata?: number;
    recent_users?: Array<{
        id: number;
        name: string;
        email: string;
        role?: { display_name: string };
        desa?: { nama_desa: string };
    }>;
    recent_data?: {
        umkm?: Array<{
            id: number;
            nama_usaha: string;
            jenis_usaha: string;
            pemilik: string;
            status: string;
        }>;
        pariwisata?: Array<{
            id: number;
            nama_objek: string;
            jenis: string;
            status: string;
        }>;
    };
    desa_list?: Array<{
        id: number;
        nama_desa: string;
        kecamatan?: { nama_kecamatan: string };
        umkms_count?: number;
        demografis_count?: number;
    }>;
}

interface Props {
    stats: DashboardStats;
    role_type?: string;
    [key: string]: unknown;
}

export default function Dashboard({ stats, role_type }: Props) {
    return (
        <AppShell>
            <Head title="Dashboard - Potensi Desa" />
            
            <div className="p-6">
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-100">
                        🏘️ Dashboard Potensi Desa
                    </h1>
                    <p className="text-gray-600 dark:text-gray-400 mt-2">
                        {role_type === 'super_admin' && 'Kelola seluruh sistem dan data desa'}
                        {role_type === 'admin_kabupaten' && 'Pantau laporan tingkat kabupaten'}
                        {role_type === 'admin_kecamatan' && 'Monitor data desa dalam kecamatan'}
                        {role_type === 'admin_desa' && `Kelola data ${stats.desa_name || 'desa Anda'}`}
                    </p>
                </div>

                {/* Super Admin Dashboard */}
                {role_type === 'super_admin' && (
                    <div className="space-y-6">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">👥</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Pengguna</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_users || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏘️</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Desa</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_desa || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏪</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total UMKM</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_umkm || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">📊</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Penduduk</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_penduduk?.toLocaleString() || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {stats.recent_users && (
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                    👤 Pengguna Terbaru
                                </h3>
                                <div className="space-y-3">
                                    {stats.recent_users.map((user) => (
                                        <div key={user.id} className="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-gray-100">{user.name}</p>
                                                <p className="text-sm text-gray-500 dark:text-gray-400">
                                                    {user.email} • {user.role?.display_name}
                                                </p>
                                            </div>
                                            <span className="text-sm text-gray-400">
                                                {user.desa?.nama_desa || 'Belum ada desa'}
                                            </span>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                )}

                {/* Admin Desa Dashboard */}
                {role_type === 'admin_desa' && (
                    <div className="space-y-6">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏪</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total UMKM</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_umkm || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">👥</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Penduduk</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_penduduk?.toLocaleString() || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏗️</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Fasilitas Umum</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_fasilitas || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🎭</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Objek Wisata</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_pariwisata || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Quick Actions */}
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                ⚡ Aksi Cepat
                            </h3>
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <a
                                    href="/demografis/create"
                                    className="p-4 text-center bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors"
                                >
                                    <div className="text-2xl mb-2">👥</div>
                                    <p className="text-sm font-medium">Tambah Demografi</p>
                                </a>
                                <a
                                    href="/umkms/create"
                                    className="p-4 text-center bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors"
                                >
                                    <div className="text-2xl mb-2">🏪</div>
                                    <p className="text-sm font-medium">Tambah UMKM</p>
                                </a>
                                <a
                                    href="/fasilitas-umums/create"
                                    className="p-4 text-center bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors"
                                >
                                    <div className="text-2xl mb-2">🏗️</div>
                                    <p className="text-sm font-medium">Tambah Fasilitas</p>
                                </a>
                                <a
                                    href="/pariwisata-budayas/create"
                                    className="p-4 text-center bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors"
                                >
                                    <div className="text-2xl mb-2">🎭</div>
                                    <p className="text-sm font-medium">Tambah Wisata</p>
                                </a>
                            </div>
                        </div>

                        {/* Recent Data */}
                        {stats.recent_data && (
                            <div className="grid md:grid-cols-2 gap-6">
                                {stats.recent_data.umkm && stats.recent_data.umkm.length > 0 && (
                                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                            🏪 UMKM Terbaru
                                        </h3>
                                        <div className="space-y-3">
                                            {stats.recent_data.umkm.slice(0, 5).map((umkm) => (
                                                <div key={umkm.id} className="flex justify-between items-start">
                                                    <div>
                                                        <p className="font-medium text-gray-900 dark:text-gray-100">{umkm.nama_usaha}</p>
                                                        <p className="text-sm text-gray-500 dark:text-gray-400">
                                                            {umkm.jenis_usaha} • {umkm.pemilik}
                                                        </p>
                                                    </div>
                                                    <span className={`px-2 py-1 rounded text-xs ${
                                                        umkm.status === 'aktif' 
                                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' 
                                                            : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400'
                                                    }`}>
                                                        {umkm.status}
                                                    </span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {stats.recent_data.pariwisata && stats.recent_data.pariwisata.length > 0 && (
                                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                            🎭 Wisata & Budaya
                                        </h3>
                                        <div className="space-y-3">
                                            {stats.recent_data.pariwisata.slice(0, 3).map((item) => (
                                                <div key={item.id} className="flex justify-between items-start">
                                                    <div>
                                                        <p className="font-medium text-gray-900 dark:text-gray-100">{item.nama_objek}</p>
                                                        <p className="text-sm text-gray-500 dark:text-gray-400">
                                                            {item.jenis.replace('_', ' ')}
                                                        </p>
                                                    </div>
                                                    <span className={`px-2 py-1 rounded text-xs ${
                                                        item.status === 'aktif' 
                                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' 
                                                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400'
                                                    }`}>
                                                        {item.status}
                                                    </span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                )}

                {/* Other role types */}
                {(role_type === 'admin_kabupaten' || role_type === 'admin_kecamatan') && (
                    <div className="space-y-6">
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏘️</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Desa</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_desa || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">🏪</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total UMKM</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_umkm || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <div className="flex items-center">
                                    <div className="text-3xl mr-4">👥</div>
                                    <div>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">Total Penduduk</p>
                                        <p className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {stats.total_penduduk?.toLocaleString() || 0}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {stats.desa_list && (
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                    📋 Daftar Desa
                                </h3>
                                <div className="overflow-x-auto">
                                    <table className="w-full text-sm">
                                        <thead className="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th className="px-4 py-2 text-left">Nama Desa</th>
                                                {role_type === 'admin_kabupaten' && <th className="px-4 py-2 text-left">Kecamatan</th>}
                                                <th className="px-4 py-2 text-center">UMKM</th>
                                                <th className="px-4 py-2 text-center">Data Demografi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {stats.desa_list.map((desa) => (
                                                <tr key={desa.id} className="border-b border-gray-200 dark:border-gray-700">
                                                    <td className="px-4 py-2 font-medium">{desa.nama_desa}</td>
                                                    {role_type === 'admin_kabupaten' && (
                                                        <td className="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                            {desa.kecamatan?.nama_kecamatan}
                                                        </td>
                                                    )}
                                                    <td className="px-4 py-2 text-center">{desa.umkms_count || 0}</td>
                                                    <td className="px-4 py-2 text-center">{desa.demografis_count || 0}</td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        )}
                    </div>
                )}
            </div>
        </AppShell>
    );
}