import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { BookOpen, Folder, LayoutGrid, Users, Building2, MapPin, Palmtree, GraduationCap, HeartHandshake } from 'lucide-react';
import AppLogo from './app-logo';

const getMainNavItems = (userRole: string): NavItem[] => [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    ...(userRole === 'admin_desa' || userRole === 'super_admin' ? [
        {
            title: 'Data Demografi',
            href: '/demografis',
            icon: Users,
        },
        {
            title: 'UMKM',
            href: '/umkms',
            icon: Building2,
        },
        {
            title: 'Fasilitas Umum',
            href: '/fasilitas-umums',
            icon: MapPin,
        },
        {
            title: 'Pendidikan',
            href: '/pendidikans',
            icon: GraduationCap,
        },
        {
            title: 'Kesehatan',
            href: '/kesehatans',
            icon: HeartHandshake,
        },
        {
            title: 'Pariwisata & Budaya',
            href: '/pariwisata-budayas',
            icon: Palmtree,
        },
    ] : []),
    ...(userRole === 'admin_kecamatan' || userRole === 'admin_kabupaten' || userRole === 'super_admin' ? [
        {
            title: 'Laporan Demografi',
            href: '/demografis',
            icon: Users,
        },
        {
            title: 'Laporan UMKM',
            href: '/umkms',
            icon: Building2,
        },
    ] : []),
];

const footerNavItems: NavItem[] = [
    {
        title: 'Panduan',
        href: '/help',
        icon: BookOpen,
    },
    {
        title: 'Tentang Sistem',
        href: '/about',
        icon: Folder,
    },
];

interface AuthProps {
    auth: {
        user?: {
            role?: {
                name: string;
            };
        };
    };
    [key: string]: unknown;
}

export function AppSidebar() {
    const { auth } = usePage<AuthProps>().props;
    const userRole = auth.user?.role?.name || 'guest';
    const mainNavItems = getMainNavItems(userRole);

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
