import { useState } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';

export default function Authenticated({ user, header, children }) {
    /*
        <div className="flex items-center bg-white">
            <Link href="/">
                <ApplicationLogo className="block w-auto fill-current text-gray-800 h-24 p-6" />
            </Link>
        </div>
     */

    return (
        <div className="flex flex-col max-w-full p-6">
            <main>
                {children}
            </main>
        </div>
    );
}
