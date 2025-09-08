import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Potensi Desa CRUD - Sistem Pendataan Potensi Desa">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
                {/* Navigation */}
                <header className="sticky top-0 z-50 bg-white/80 backdrop-blur-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <nav className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                        <div className="flex items-center space-x-3">
                            <div className="w-8 h-8 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold text-sm">🏘️</span>
                            </div>
                            <div>
                                <h1 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Potensi Desa
                                </h1>
                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                    Sistem Pendataan
                                </p>
                            </div>
                        </div>
                        
                        <div className="flex items-center space-x-2">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <div className="flex items-center space-x-2">
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 font-medium transition-colors"
                                    >
                                        Masuk
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                                    >
                                        Daftar
                                    </Link>
                                </div>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <section className="py-20">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div className="mb-8">
                            <span className="text-6xl mb-4 block">🏘️</span>
                            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                <span className="bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                                    Sistem Pendataan
                                </span>
                                <br />
                                Potensi Desa
                            </h1>
                            <p className="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                                Platform terpadu untuk mengelola dan memantau potensi desa secara komprehensif. 
                                Kelola data demografi, ekonomi, infrastruktur, dan pariwisata dengan sistem yang terintegrasi.
                            </p>
                        </div>
                        
                        {!auth.user && (
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link
                                    href={route('register')}
                                    className="px-8 py-3 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg"
                                >
                                    🚀 Mulai Sekarang
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="px-8 py-3 bg-white hover:bg-gray-50 text-gray-900 rounded-xl font-semibold text-lg border border-gray-200 transition-all shadow-lg dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600 dark:hover:bg-gray-700"
                                >
                                    📊 Lihat Demo
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-16 bg-white/50 dark:bg-gray-800/50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                🎯 Fitur Unggulan
                            </h2>
                            <p className="text-lg text-gray-600 dark:text-gray-300">
                                Solusi lengkap untuk pendataan dan analisis potensi desa
                            </p>
                        </div>
                        
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                                <div className="text-3xl mb-4">👥</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    Data Demografi
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Kelola data penduduk berdasarkan usia, agama, pendidikan, dan pekerjaan secara detail
                                </p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                                <div className="text-3xl mb-4">🏪</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    Potensi Ekonomi
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Pantau UMKM, sumber daya alam, pertanian, dan perikanan untuk kemajuan ekonomi desa
                                </p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                                <div className="text-3xl mb-4">🏗️</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    Infrastruktur
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Monitor fasilitas umum, pendidikan, kesehatan, dan jaringan transportasi
                                </p>
                            </div>
                            
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                                <div className="text-3xl mb-4">🎭</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    Pariwisata & Budaya
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Dokumentasi objek wisata, budaya adat, dan seni tradisional untuk promosi desa
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Role Management Section */}
                <section className="py-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                🔐 Sistem Multi-Level
                            </h2>
                            <p className="text-lg text-gray-600 dark:text-gray-300">
                                Akses berbasis peran untuk keamanan dan efisiensi data
                            </p>
                        </div>
                        
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="text-center p-6 bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-xl border border-purple-100 dark:border-purple-800">
                                <div className="text-4xl mb-3">👑</div>
                                <h4 className="font-semibold text-gray-900 dark:text-gray-100 mb-2">Super Admin</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-300">Akses penuh ke seluruh sistem dan manajemen pengguna</p>
                            </div>
                            
                            <div className="text-center p-6 bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                                <div className="text-4xl mb-3">🏛️</div>
                                <h4 className="font-semibold text-gray-900 dark:text-gray-100 mb-2">Admin Kabupaten</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-300">Laporan dan dashboard tingkat kabupaten</p>
                            </div>
                            
                            <div className="text-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-100 dark:border-green-800">
                                <div className="text-4xl mb-3">🏢</div>
                                <h4 className="font-semibold text-gray-900 dark:text-gray-100 mb-2">Admin Kecamatan</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-300">Monitoring desa dalam kecamatan</p>
                            </div>
                            
                            <div className="text-center p-6 bg-gradient-to-br from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-xl border border-orange-100 dark:border-orange-800">
                                <div className="text-4xl mb-3">🏘️</div>
                                <h4 className="font-semibold text-gray-900 dark:text-gray-100 mb-2">Admin Desa</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-300">Kelola data spesifik desa</p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Stats Preview */}
                <section className="py-16 bg-gradient-to-r from-green-600 to-blue-600 text-white">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold mb-4">📈 Analisis & Laporan</h2>
                            <p className="text-lg opacity-90">
                                Data real-time dengan visualisasi yang mudah dipahami
                            </p>
                        </div>
                        
                        <div className="grid md:grid-cols-3 gap-8 text-center">
                            <div className="p-6">
                                <div className="text-4xl mb-4">📊</div>
                                <div className="text-3xl font-bold mb-2">100%</div>
                                <p className="opacity-90">Dashboard Interaktif</p>
                            </div>
                            
                            <div className="p-6">
                                <div className="text-4xl mb-4">📋</div>
                                <div className="text-3xl font-bold mb-2">15+</div>
                                <p className="opacity-90">Modul Data Lengkap</p>
                            </div>
                            
                            <div className="p-6">
                                <div className="text-4xl mb-4">🔒</div>
                                <div className="text-3xl font-bold mb-2">4</div>
                                <p className="opacity-90">Level Akses Berbeda</p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* CTA Section */}
                <section className="py-20 bg-white dark:bg-gray-800">
                    <div className="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            🚀 Siap Digitalisasi Desa Anda?
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 mb-8">
                            Bergabunglah dengan sistem manajemen data desa terdepan. 
                            Mudah digunakan, aman, dan terintegrasi.
                        </p>
                        
                        {!auth.user && (
                            <div className="space-y-4">
                                <Link
                                    href={route('register')}
                                    className="inline-block px-8 py-4 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg"
                                >
                                    🌟 Mulai Gratis Sekarang
                                </Link>
                                <div className="text-sm text-gray-500 dark:text-gray-400">
                                    Login demo: admin@potensi-desa.com | password: password
                                </div>
                            </div>
                        )}
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-50 dark:bg-gray-900 py-8 border-t border-gray-200 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <p className="text-gray-600 dark:text-gray-300">
                            © 2024 Potensi Desa CRUD. Sistem Pendataan Potensi Desa Modern.
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}