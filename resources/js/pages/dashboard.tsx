import { usePage } from '@inertiajs/react';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

interface DashboardStats {
    total_kabupaten?: number;
    total_kecamatan?: number;
    total_desa?: number;
    total_users?: number;
    recent_desas?: Array<{
        id: number;
        nama_desa: string;
        kabupaten: { nama_kabupaten: string };
        kecamatan: { nama_kecamatan: string };
        created_at: string;
    }>;
    desa?: {
        id: number;
        nama_desa: string;
        kabupaten: { nama_kabupaten: string };
        kecamatan: { nama_kecamatan: string };
        kepala_desa: string;
        luas_wilayah_total: string;
    };
    total_demografi?: number;
    total_umkm?: number;
    message?: string;
    error?: string;
    [key: string]: unknown;
}

interface Props {
    stats: DashboardStats;
    userRole: string;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ stats, userRole }: Props) {
    const { auth } = usePage<{ auth: { user: { name: string } } }>().props;

    const renderSuperAdminDashboard = () => (
        <div className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                    <div className="flex items-center">
                        <div className="p-3 bg-blue-100 rounded-full dark:bg-blue-900">
                            <span className="text-2xl">🏛️</span>
                        </div>
                        <div className="ml-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Kabupaten</h3>
                            <p className="text-3xl font-bold text-blue-600">{stats.total_kabupaten || 0}</p>
                        </div>
                    </div>
                </div>

                <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                    <div className="flex items-center">
                        <div className="p-3 bg-green-100 rounded-full dark:bg-green-900">
                            <span className="text-2xl">🏢</span>
                        </div>
                        <div className="ml-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Kecamatan</h3>
                            <p className="text-3xl font-bold text-green-600">{stats.total_kecamatan || 0}</p>
                        </div>
                    </div>
                </div>

                <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                    <div className="flex items-center">
                        <div className="p-3 bg-yellow-100 rounded-full dark:bg-yellow-900">
                            <span className="text-2xl">🏘️</span>
                        </div>
                        <div className="ml-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Desa</h3>
                            <p className="text-3xl font-bold text-yellow-600">{stats.total_desa || 0}</p>
                        </div>
                    </div>
                </div>

                <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                    <div className="flex items-center">
                        <div className="p-3 bg-purple-100 rounded-full dark:bg-purple-900">
                            <span className="text-2xl">👥</span>
                        </div>
                        <div className="ml-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Users</h3>
                            <p className="text-3xl font-bold text-purple-600">{stats.total_users || 0}</p>
                        </div>
                    </div>
                </div>
            </div>

            {stats.recent_desas && stats.recent_desas.length > 0 && (
                <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                    <h3 className="text-lg font-semibold text-gray-900 mb-4 dark:text-white">Recent Villages</h3>
                    <div className="overflow-x-auto">
                        <table className="min-w-full">
                            <thead>
                                <tr className="border-b">
                                    <th className="text-left py-2">Village Name</th>
                                    <th className="text-left py-2">District</th>
                                    <th className="text-left py-2">Regency</th>
                                    <th className="text-left py-2">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                {stats.recent_desas.map((desa) => (
                                    <tr key={desa.id} className="border-b">
                                        <td className="py-2">{desa.nama_desa}</td>
                                        <td className="py-2">{desa.kecamatan.nama_kecamatan}</td>
                                        <td className="py-2">{desa.kabupaten.nama_kabupaten}</td>
                                        <td className="py-2">{new Date(desa.created_at).toLocaleDateString()}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            )}
        </div>
    );

    const renderAdminDesaDashboard = () => (
        <div className="space-y-6">
            {stats.error ? (
                <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded dark:bg-red-900 dark:border-red-600 dark:text-red-200">
                    {stats.error}
                </div>
            ) : stats.desa ? (
                <>
                    <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                        <h2 className="text-2xl font-bold text-gray-900 mb-4 dark:text-white">
                            🏘️ {stats.desa.nama_desa}
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 dark:text-gray-300">
                            <div>
                                <span className="font-semibold">Kabupaten:</span> {stats.desa.kabupaten.nama_kabupaten}
                            </div>
                            <div>
                                <span className="font-semibold">Kecamatan:</span> {stats.desa.kecamatan.nama_kecamatan}
                            </div>
                            <div>
                                <span className="font-semibold">Kepala Desa:</span> {stats.desa.kepala_desa}
                            </div>
                            <div>
                                <span className="font-semibold">Luas Wilayah:</span> {stats.desa.luas_wilayah_total} Ha
                            </div>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                            <div className="flex items-center">
                                <div className="p-3 bg-blue-100 rounded-full dark:bg-blue-900">
                                    <span className="text-2xl">📈</span>
                                </div>
                                <div className="ml-4">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Data Demografi</h3>
                                    <p className="text-3xl font-bold text-blue-600">{stats.total_demografi || 0}</p>
                                    <p className="text-sm text-gray-500 dark:text-gray-400">Records</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                            <div className="flex items-center">
                                <div className="p-3 bg-green-100 rounded-full dark:bg-green-900">
                                    <span className="text-2xl">💼</span>
                                </div>
                                <div className="ml-4">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white">UMKM</h3>
                                    <p className="text-3xl font-bold text-green-600">{stats.total_umkm || 0}</p>
                                    <p className="text-sm text-gray-500 dark:text-gray-400">Businesses</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="bg-gradient-to-r from-blue-50 to-green-50 p-6 rounded-lg dark:from-blue-900/20 dark:to-green-900/20">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4 dark:text-white">Quick Actions</h3>
                        <div className="flex flex-wrap gap-3">
                            <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                📊 Add Demographics
                            </button>
                            <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                💼 Register UMKM
                            </button>
                            <button className="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                🏗️ Update Infrastructure
                            </button>
                            <button className="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                                📈 Generate Report
                            </button>
                        </div>
                    </div>
                </>
            ) : null}
        </div>
    );

    const renderOtherRolesDashboard = () => (
        <div className="space-y-6">
            <div className="bg-white p-8 rounded-lg shadow text-center dark:bg-gray-800">
                <div className="text-6xl mb-4">
                    {userRole === 'admin_kecamatan' ? '🏢' : '🏛️'}
                </div>
                <h2 className="text-2xl font-bold text-gray-900 mb-4 dark:text-white">
                    {userRole === 'admin_kecamatan' ? 'Kecamatan Dashboard' : 'Kabupaten Dashboard'}
                </h2>
                <p className="text-gray-600 dark:text-gray-300">
                    {stats.message || 'Dashboard is under development for this role.'}
                </p>
            </div>
        </div>
    );

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="p-6">
                {/* Welcome Header */}
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        Welcome back, {auth.user.name}! 👋
                    </h1>
                    <p className="text-gray-600 dark:text-gray-300 mt-2">
                        Role: <span className="font-semibold capitalize">{userRole.replace('_', ' ')}</span>
                    </p>
                </div>

                {/* Role-specific Dashboard Content */}
                {userRole === 'super_admin' && renderSuperAdminDashboard()}
                {userRole === 'admin_desa' && renderAdminDesaDashboard()}
                {(userRole === 'admin_kecamatan' || userRole === 'admin_kabupaten') && renderOtherRolesDashboard()}
            </div>
        </AppLayout>
    );
}