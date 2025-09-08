import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { BookOpen, Building, Folder, LayoutGrid, MapPin, TrendingUp, Users } from 'lucide-react';
import AppLogo from './app-logo';

function getMainNavItems(userRole?: string): NavItem[] {
    const baseItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
            icon: LayoutGrid,
        },
    ];

    if (userRole === 'super_admin') {
        return [
            ...baseItems,
            {
                title: 'Master Data',
                href: '/kabupaten',
                icon: Building,
            },
            {
                title: 'Data Demografi',
                href: '/demografi',
                icon: Users,
            },
        ];
    }

    if (userRole === 'admin_desa') {
        return [
            ...baseItems,
            {
                title: 'Data Demografi',
                href: '/demografi',
                icon: Users,
            },
            {
                title: 'UMKM & Ekonomi',
                href: '/umkm',
                icon: TrendingUp,
            },
        ];
    }

    if (userRole === 'admin_kecamatan' || userRole === 'admin_kabupaten') {
        return [
            ...baseItems,
            {
                title: 'Laporan Desa',
                href: '/demografi',
                icon: MapPin,
            },
        ];
    }

    return baseItems;
}

const footerNavItems: NavItem[] = [
    {
        title: 'Tentang Sistem',
        href: '#',
        icon: BookOpen,
    },
    {
        title: 'Panduan',
        href: '#',
        icon: Folder,
    },
];

export function AppSidebar() {
    const { auth } = usePage<{ auth: { user: { roles?: Array<{ name: string }> } } }>().props;
    const userRole = auth.user.roles?.[0]?.name;
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
