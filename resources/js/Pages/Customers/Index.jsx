import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Index({ customers }) {
    return (
        <AuthenticatedLayout header={<h2 className="text-2xl font-bold">Customer Aktif</h2>}>
            <Head title="Customer Aktif" />

            <div className="max-w-5xl mx-auto py-6">
                <div className="bg-white shadow rounded-xl p-6">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th className="px-4 py-2 text-left">Nama</th>
                                <th className="px-4 py-2 text-left">Kontak</th>
                                <th className="px-4 py-2 text-left">Layanan</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-200">
                            {customers.data.map((c) => (
                                <tr key={c.id}>
                                    <td className="px-4 py-2">{c.name}</td>
                                    <td className="px-4 py-2">{c.contact}</td>
                                    <td className="px-4 py-2">
                                        {c.products.map((p) => (
                                            <div key={p.id}>
                                                {p.name} (Rp {p.pivot.harga_nego})
                                            </div>
                                        ))}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
