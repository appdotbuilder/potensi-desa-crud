import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Pendataan Potensi Desa">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="absolute top-0 right-0 p-6">
                    <nav className="flex items-center gap-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200"
                            >
                                📊 Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="inline-flex items-center px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 dark:text-gray-300"
                                >
                                    Login
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>

                {/* Hero Section */}
                <div className="flex flex-col items-center justify-center min-h-screen px-6 lg:px-8">
                    <div className="max-w-4xl mx-auto text-center">
                        {/* Logo/Icon */}
                        <div className="mb-8">
                            <div className="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-4 dark:bg-green-800">
                                <span className="text-4xl">🏘️</span>
                            </div>
                        </div>

                        {/* Main Heading */}
                        <h1 className="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 dark:text-white">
                            🌾 <span className="text-green-600">Pendataan</span>{' '}
                            <span className="text-blue-600">Potensi Desa</span>
                        </h1>
                        
                        <p className="text-xl lg:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto dark:text-gray-300">
                            Sistem manajemen data komprehensif untuk mengelola potensi dan 
                            pembangunan desa secara terpadu dan efisien
                        </p>

                        {/* Feature Highlights */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                            <div className="bg-white p-6 rounded-xl shadow-lg dark:bg-gray-800">
                                <div className="text-3xl mb-3">📈</div>
                                <h3 className="font-semibold text-gray-900 mb-2 dark:text-white">Data Demografi</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Kelola data penduduk, usia, pendidikan, dan pekerjaan
                                </p>
                            </div>
                            
                            <div className="bg-white p-6 rounded-xl shadow-lg dark:bg-gray-800">
                                <div className="text-3xl mb-3">💼</div>
                                <h3 className="font-semibold text-gray-900 mb-2 dark:text-white">Ekonomi & UMKM</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Pantau usaha kecil, pertanian, perkebunan, dan SDA
                                </p>
                            </div>
                            
                            <div className="bg-white p-6 rounded-xl shadow-lg dark:bg-gray-800">
                                <div className="text-3xl mb-3">🏗️</div>
                                <h3 className="font-semibold text-gray-900 mb-2 dark:text-white">Infrastruktur</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Fasilitas umum, pendidikan, kesehatan, dan transportasi
                                </p>
                            </div>
                            
                            <div className="bg-white p-6 rounded-xl shadow-lg dark:bg-gray-800">
                                <div className="text-3xl mb-3">🎭</div>
                                <h3 className="font-semibold text-gray-900 mb-2 dark:text-white">Pariwisata & Budaya</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Kelola objek wisata, seni tradisional, dan adat
                                </p>
                            </div>
                        </div>

                        {/* User Roles */}
                        <div className="bg-white rounded-2xl p-8 mb-12 shadow-xl dark:bg-gray-800">
                            <h2 className="text-2xl font-bold text-gray-900 mb-6 dark:text-white">
                                🎯 Multi-Level Access Management
                            </h2>
                            <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                                <div className="p-4 bg-red-50 rounded-lg dark:bg-red-900/20">
                                    <div className="text-2xl mb-2">👑</div>
                                    <div className="font-semibold text-red-700 dark:text-red-300">Super Admin</div>
                                    <div className="text-red-600 dark:text-red-400">Full system control</div>
                                </div>
                                <div className="p-4 bg-blue-50 rounded-lg dark:bg-blue-900/20">
                                    <div className="text-2xl mb-2">🏛️</div>
                                    <div className="font-semibold text-blue-700 dark:text-blue-300">Admin Kabupaten</div>
                                    <div className="text-blue-600 dark:text-blue-400">Regency overview</div>
                                </div>
                                <div className="p-4 bg-green-50 rounded-lg dark:bg-green-900/20">
                                    <div className="text-2xl mb-2">🏢</div>
                                    <div className="font-semibold text-green-700 dark:text-green-300">Admin Kecamatan</div>
                                    <div className="text-green-600 dark:text-green-400">District summaries</div>
                                </div>
                                <div className="p-4 bg-yellow-50 rounded-lg dark:bg-yellow-900/20">
                                    <div className="text-2xl mb-2">🏘️</div>
                                    <div className="font-semibold text-yellow-700 dark:text-yellow-300">Admin Desa</div>
                                    <div className="text-yellow-600 dark:text-yellow-400">Village management</div>
                                </div>
                            </div>
                        </div>

                        {/* CTA Buttons */}
                        {!auth.user && (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg"
                                >
                                    🚀 Mulai Sekarang
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-xl border border-gray-300 transition-all duration-200 transform hover:scale-105 shadow-lg dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700"
                                >
                                    🔑 Login
                                </Link>
                            </div>
                        )}

                        {/* Features Preview */}
                        <div className="mt-16 max-w-5xl mx-auto">
                            <h2 className="text-2xl font-bold text-gray-900 mb-8 dark:text-white">
                                ✨ Fitur Unggulan
                            </h2>
                            <div className="grid md:grid-cols-3 gap-8">
                                <div className="text-center">
                                    <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 dark:bg-blue-900">
                                        <span className="text-2xl">📊</span>
                                    </div>
                                    <h3 className="font-semibold mb-2 dark:text-white">Real-time Analytics</h3>
                                    <p className="text-gray-600 text-sm dark:text-gray-400">
                                        Dashboard interaktif dengan grafik dan laporan lengkap
                                    </p>
                                </div>
                                <div className="text-center">
                                    <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 dark:bg-green-900">
                                        <span className="text-2xl">📁</span>
                                    </div>
                                    <h3 className="font-semibold mb-2 dark:text-white">Export & Import</h3>
                                    <p className="text-gray-600 text-sm dark:text-gray-400">
                                        Ekspor ke Excel/PDF, import data massal dengan mudah
                                    </p>
                                </div>
                                <div className="text-center">
                                    <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 dark:bg-purple-900">
                                        <span className="text-2xl">🔐</span>
                                    </div>
                                    <h3 className="font-semibold mb-2 dark:text-white">Secure & Reliable</h3>
                                    <p className="text-gray-600 text-sm dark:text-gray-400">
                                        Sistem keamanan berlapis dengan backup otomatis
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Footer */}
                    <footer className="mt-16 text-center text-gray-500 text-sm dark:text-gray-400">
                        <p>
                            Built with ❤️ for Indonesian Villages |{' '}
                            <span className="font-semibold text-green-600">Potensi Desa CRUD v1.0</span>
                        </p>
                    </footer>
                </div>
            </div>
        </>
    );
}