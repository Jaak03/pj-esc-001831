import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Success({ auth, status, method, transactionId, reference }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Success</h2>}
        >
            <Head title="Success" />

            <div className="grid grid-cols-3 grid-rows-3 h-[94vh]">
                <div className="col-start-2 row-start-2">
                    <h1 className="text-center text-xl text-bold">Success</h1>
                    <p className="text-center text-lg">Thank you for your purchase {auth.user.name}. We have sent a message to "{auth.user.email}" with relevant information about your purchase and next steps from here.</p>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
