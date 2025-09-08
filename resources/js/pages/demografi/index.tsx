import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

interface Demografi {
    id: number;
    total_penduduk: number;
    laki_laki: number;
    perempuan: number;
    usia_0_2: number;
    usia_0_5: number;
    usia_17_plus: number;
    agama: string;
    pendidikan_terakhir: string;
    pekerjaan: string;
    created_at: string;
    desa: {
        nama_desa: string;
        kecamatan: {
            nama_kecamatan: string;
            kabupaten: {
                nama_kabupaten: string;
            };
        };
    };
}

interface Props {
    demografis: {
        data: Demografi[];
        current_page: number;
        last_page: number;
        total: number;
        per_page: number;
    };
    filters: {
        search?: string;
    };
    userRole: string;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Demografi', href: '/demografi' },
];

export default function DemografiIndex({ demografis, filters, userRole }: Props) {
    const [searchTerm, setSearchTerm] = React.useState(filters.search || '');

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        router.get('/demografi', { search: searchTerm }, { preserveState: true });
    };

    const canCreateEdit = ['super_admin', 'admin_desa'].includes(userRole);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Demografi" />
            
            <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            📈 Data Demografi Penduduk
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Kelola data penduduk dan karakteristik demografis
                        </p>
                    </div>

                    {canCreateEdit && (
                        <Link
                            href="/demografi/create"
                            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            ➕ Tambah Data
                        </Link>
                    )}
                </div>

                {/* Search */}
                <div className="bg-white p-4 rounded-lg shadow dark:bg-gray-800">
                    <form onSubmit={handleSearch} className="flex gap-4">
                        <input
                            type="text"
                            placeholder="Cari berdasarkan nama desa..."
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                            className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                        <button
                            type="submit"
                            className="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors"
                        >
                            🔍 Cari
                        </button>
                    </form>
                </div>

                {/* Statistics */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div className="bg-blue-50 p-4 rounded-lg dark:bg-blue-900/20">
                        <div className="text-2xl font-bold text-blue-600">
                            {demografis.total}
                        </div>
                        <div className="text-blue-700 dark:text-blue-300">Total Data Demografi</div>
                    </div>
                    <div className="bg-green-50 p-4 rounded-lg dark:bg-green-900/20">
                        <div className="text-2xl font-bold text-green-600">
                            {demografis.data.reduce((sum, item) => sum + item.total_penduduk, 0).toLocaleString()}
                        </div>
                        <div className="text-green-700 dark:text-green-300">Total Penduduk</div>
                    </div>
                    <div className="bg-purple-50 p-4 rounded-lg dark:bg-purple-900/20">
                        <div className="text-2xl font-bold text-purple-600">
                            {demografis.data.length > 0 ? Math.round(demografis.data.reduce((sum, item) => sum + item.total_penduduk, 0) / demografis.data.length) : 0}
                        </div>
                        <div className="text-purple-700 dark:text-purple-300">Rata-rata per Desa</div>
                    </div>
                </div>

                {/* Data Table */}
                <div className="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
                    <div className="overflow-x-auto">
                        <table className="min-w-full">
                            <thead className="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Desa
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Total Penduduk
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Laki-laki
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Perempuan
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Agama
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Pekerjaan
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                {demografis.data.map((demografi) => (
                                    <tr key={demografi.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                {demografi.desa.nama_desa}
                                            </div>
                                            <div className="text-sm text-gray-500 dark:text-gray-400">
                                                {demografi.desa.kecamatan.nama_kecamatan}, {demografi.desa.kecamatan.kabupaten.nama_kabupaten}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {demografi.total_penduduk.toLocaleString()}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {demografi.laki_laki.toLocaleString()}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {demografi.perempuan.toLocaleString()}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {demografi.agama}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {demografi.pekerjaan}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <Link
                                                href={`/demografi/${demografi.id}`}
                                                className="text-blue-600 hover:text-blue-900 dark:text-blue-400"
                                            >
                                                👁️ Lihat
                                            </Link>
                                            {canCreateEdit && (
                                                <>
                                                    <Link
                                                        href={`/demografi/${demografi.id}/edit`}
                                                        className="text-green-600 hover:text-green-900 dark:text-green-400"
                                                    >
                                                        ✏️ Edit
                                                    </Link>
                                                    <button
                                                        onClick={() => {
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                router.delete(`/demografi/${demografi.id}`);
                                                            }
                                                        }}
                                                        className="text-red-600 hover:text-red-900 dark:text-red-400"
                                                    >
                                                        🗑️ Hapus
                                                    </button>
                                                </>
                                            )}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination Info */}
                    <div className="bg-gray-50 px-6 py-3 flex items-center justify-between dark:bg-gray-700">
                        <div className="text-sm text-gray-700 dark:text-gray-300">
                            Showing {demografis.data.length} of {demografis.total} results
                        </div>
                        <div className="text-sm text-gray-700 dark:text-gray-300">
                            Page {demografis.current_page} of {demografis.last_page}
                        </div>
                    </div>
                </div>

                {/* Empty State */}
                {demografis.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">📊</div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            Belum ada data demografi
                        </h3>
                        <p className="text-gray-500 dark:text-gray-400">
                            {canCreateEdit ? 'Mulai dengan menambahkan data demografi pertama' : 'Data akan muncul setelah admin desa menambahkannya'}
                        </p>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}