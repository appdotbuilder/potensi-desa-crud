import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link, router } from '@inertiajs/react';

interface Demografi {
    id: number;
    total_penduduk: number;
    laki_laki: number;
    perempuan: number;
    tahun_data: number;
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
    demografis: {
        data: Demografi[];
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
    [key: string]: unknown;
}

export default function DemografiIndex({ demografis, can_create }: Props) {
    const handleDelete = (id: number) => {
        if (confirm('Apakah Anda yakin ingin menghapus data demografi ini?')) {
            router.delete(`/demografis/${id}`);
        }
    };

    return (
        <AppShell>
            <Head title="Data Demografi - Potensi Desa" />
            
            <div className="p-6">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            👥 Data Demografi Penduduk
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Kelola data kependudukan berdasarkan demografi
                        </p>
                    </div>
                    {can_create && (
                        <Link
                            href="/demografis/create"
                            className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                        >
                            + Tambah Data
                        </Link>
                    )}
                </div>

                <div className="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    {demografis.data.length === 0 ? (
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">📊</div>
                            <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                Belum Ada Data Demografi
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 mb-4">
                                Mulai dengan menambahkan data demografi penduduk desa.
                            </p>
                            {can_create && (
                                <Link
                                    href="/demografis/create"
                                    className="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                                >
                                    Tambah Data Pertama
                                </Link>
                            )}
                        </div>
                    ) : (
                        <div className="overflow-x-auto">
                            <table className="w-full">
                                <thead className="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Desa
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tahun
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Total Penduduk
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Laki-laki
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Perempuan
                                        </th>
                                        <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    {demografis.data.map((item) => (
                                        <tr key={item.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {item.desa.nama_desa}
                                                    </div>
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                                        {item.desa.kecamatan.nama_kecamatan}, {item.desa.kecamatan.kabupaten.nama_kabupaten}
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400 rounded">
                                                    {item.tahun_data}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center">
                                                <div className="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {item.total_penduduk.toLocaleString()}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center">
                                                <div className="text-sm text-gray-900 dark:text-gray-100">
                                                    {item.laki_laki.toLocaleString()}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center">
                                                <div className="text-sm text-gray-900 dark:text-gray-100">
                                                    {item.perempuan.toLocaleString()}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div className="flex items-center justify-center space-x-2">
                                                    <Link
                                                        href={`/demografis/${item.id}`}
                                                        className="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    >
                                                        Lihat
                                                    </Link>
                                                    {can_create && (
                                                        <>
                                                            <Link
                                                                href={`/demografis/${item.id}/edit`}
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
                    {demografis.links && demografis.links.length > 3 && (
                        <div className="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            <div className="flex justify-between items-center">
                                <div className="text-sm text-gray-700 dark:text-gray-300">
                                    Menampilkan <span className="font-medium">{demografis.from || 0}</span> sampai{' '}
                                    <span className="font-medium">{demografis.to || 0}</span> dari{' '}
                                    <span className="font-medium">{demografis.total || 0}</span> hasil
                                </div>
                                <div className="flex space-x-2">
                                    {demografis.links.map((link, index: number) => {
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