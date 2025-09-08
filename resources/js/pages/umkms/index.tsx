import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link, router } from '@inertiajs/react';

interface Umkm {
    id: number;
    nama_usaha: string;
    jenis_usaha: string;
    pemilik: string;
    jumlah_pekerja: number;
    omset_tahunan: number | null;
    status: string;
    desa: {
        nama_desa: string;
        kecamatan: {
            nama_kecamatan: string;
            kabupaten: {
                nama_kabupaten: string;
            };
        };
    };
    created_at: string;
    updated_at: string;
}

interface Props {
    umkms: {
        data: Umkm[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        from?: number;
        to?: number;
        total?: number;
    };
    can_create: boolean;
    filters: {
        search?: string;
        status?: string;
    };
    [key: string]: unknown;
}

export default function UmkmIndex({ umkms, can_create, filters }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data UMKM ini?')) {
            router.delete(`/umkms/${id}`);
        }
    };

    const formatCurrency = (amount: number | null) => {
        if (amount === null) return '-';
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const getJenisUsahaColor = (jenis: string) => {
        const colors = {
            'perdagangan': 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400',
            'jasa': 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
            'manufaktur': 'bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400',
            'kuliner': 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400',
            'kerajinan': 'bg-pink-100 text-pink-800 dark:bg-pink-900/20 dark:text-pink-400',
            'pertanian': 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-400',
        };
        return colors[jenis as keyof typeof colors] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Data UMKM - Potensi Desa" />
            
            <div className="p-6">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            🏪 Data UMKM
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Kelola data Usaha Mikro, Kecil, dan Menengah
                        </p>
                    </div>
                    {can_create && (
                        <Link
                            href="/umkms/create"
                            className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                        >
                            + Tambah UMKM
                        </Link>
                    )}
                </div>

                {/* Filters */}
                <div className="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 mb-6">
                    <form method="GET" className="flex flex-wrap gap-4">
                        <div className="flex-1 min-w-64">
                            <input
                                type="text"
                                name="search"
                                defaultValue={filters.search || ''}
                                placeholder="Cari nama usaha, pemilik, atau jenis usaha..."
                                className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            />
                        </div>
                        <div>
                            <select
                                name="status"
                                defaultValue={filters.status || ''}
                                className="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            >
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <button
                            type="submit"
                            className="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition-colors"
                        >
                            Filter
                        </button>
                        {(filters.search || filters.status) && (
                            <Link
                                href="/umkms"
                                className="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-md transition-colors"
                            >
                                Reset
                            </Link>
                        )}
                    </form>
                </div>

                <div className="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    {umkms.data.length === 0 ? (
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">🏪</div>
                            <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                {filters.search || filters.status ? 'Tidak Ada Hasil' : 'Belum Ada Data UMKM'}
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 mb-4">
                                {filters.search || filters.status 
                                    ? 'Coba ubah filter pencarian Anda.'
                                    : 'Mulai dengan menambahkan data UMKM pertama.'
                                }
                            </p>
                            {can_create && !(filters.search || filters.status) && (
                                <Link
                                    href="/umkms/create"
                                    className="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                                >
                                    Tambah UMKM Pertama
                                </Link>
                            )}
                        </div>
                    ) : (
                        <div className="overflow-x-auto">
                            <table className="w-full">
                                <thead className="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Usaha
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Desa
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Jenis
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Pekerja
                                        </th>
                                        <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Omset/Tahun
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    {umkms.data.map((item) => (
                                        <tr key={item.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {item.nama_usaha}
                                                    </div>
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                                        {item.pemilik}
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm text-gray-900 dark:text-gray-100">
                                                    {item.desa.nama_desa}
                                                </div>
                                                <div className="text-sm text-gray-500 dark:text-gray-400">
                                                    {item.desa.kecamatan.nama_kecamatan}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className={`px-2 py-1 text-xs font-medium rounded capitalize ${getJenisUsahaColor(item.jenis_usaha)}`}>
                                                    {item.jenis_usaha}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center">
                                                <div className="text-sm text-gray-900 dark:text-gray-100">
                                                    {item.jumlah_pekerja} orang
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-right">
                                                <div className="text-sm text-gray-900 dark:text-gray-100">
                                                    {formatCurrency(item.omset_tahunan)}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center">
                                                <span className={`px-2 py-1 text-xs font-medium rounded ${
                                                    item.status === 'aktif' 
                                                        ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' 
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400'
                                                }`}>
                                                    {item.status === 'aktif' ? 'Aktif' : 'Tidak Aktif'}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div className="flex items-center justify-center space-x-2">
                                                    <Link
                                                        href={`/umkms/${item.id}`}
                                                        className="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    >
                                                        Lihat
                                                    </Link>
                                                    {can_create && (
                                                        <>
                                                            <Link
                                                                href={`/umkms/${item.id}/edit`}
                                                                className="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                            >
                                                                Edit
                                                            </Link>
                                                            <button
                                                                onClick={() => handleDelete(item.id)}
                                                                className="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            >
                                                                Hapus
                                                            </button>
                                                        </>
                                                    )}
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                    
                    {/* Pagination */}
                    {umkms.links && umkms.links.length > 3 && (
                        <div className="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            <div className="flex justify-between items-center">
                                <div className="text-sm text-gray-700 dark:text-gray-300">
                                    Menampilkan <span className="font-medium">{umkms.from || 0}</span> sampai{' '}
                                    <span className="font-medium">{umkms.to || 0}</span> dari{' '}
                                    <span className="font-medium">{umkms.total || 0}</span> hasil
                                </div>
                                <div className="flex space-x-2">
                                    {umkms.links.map((link, index: number) => {
                                        if (link.url === null) {
                                            return (
                                                <span
                                                    key={index}
                                                    className="px-3 py-1 text-sm text-gray-400 cursor-not-allowed"
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            );
                                        }
                                        
                                        return (
                                            <Link
                                                key={index}
                                                href={link.url}
                                                className={`px-3 py-1 text-sm rounded ${
                                                    link.active
                                                        ? 'bg-blue-600 text-white'
                                                        : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
                                                }`}
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        );
                                    })}
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}