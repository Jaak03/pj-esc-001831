import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Success({ auth, status, method, transactionId, reference }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Success</h2>}
        >
            <Head title="Success" />

            <div>
                <p>Received a successful purchase callback:</p>
                <pre>{JSON.stringify(auth.user, null, 2)}</pre>
                <p>{status}</p>
                <p>{method}</p>
                <p>{transactionId}</p>
                <p>{reference}</p>
            </div>
        </AuthenticatedLayout>
    );
}
