import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';

export default function Index({ projects, start_date, end_date }) {
    const [start, setStart] = useState(start_date || '');
    const [end, setEnd] = useState(end_date || '');

    const filter = () => {
        router.get(route('reports.index'), { start_date: start, end_date: end });
    };

    const exportExcel = () => {
        window.location.href = route('reports.export', { start_date: start, end_date: end });
    };

    return (
        <AuthenticatedLayout header={<h2 className="text-2xl font-bold">Laporan Project</h2>}>
            <Head title="Laporan Project" />

            <div className="max-w-6xl mx-auto py-6 space-y-6">
                <div className="flex gap-4">
                    <input
                        type="date"
                        value={start}
                        onChange={(e) => setStart(e.target.value)}
                        className="border rounded p-2"
                    />
                    <input
                        type="date"
                        value={end}
                        onChange={(e) => setEnd(e.target.value)}
                        className="border rounded p-2"
                    />
                    <button onClick={filter} className="px-4 py-2 bg-blue-600 text-white rounded">
                        Filter
                    </button>
                    <button onClick={exportExcel} className="px-4 py-2 bg-green-600 text-white rounded">
                        Export Excel
                    </button>
                </div>

                <div className="bg-white shadow rounded-xl p-6">
                    <table className="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th className="px-4 py-2">ID</th>
                                <th className="px-4 py-2">Lead</th>
                                <th className="px-4 py-2">Status</th>
                                <th className="px-4 py-2">Produk</th>
                                <th className="px-4 py-2">Total Nego</th>
                                <th className="px-4 py-2">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-200">
                            {projects.map((p) => (
                                <tr key={p.id}>
                                    <td className="px-4 py-2">{p.id}</td>
                                    <td className="px-4 py-2">{p.lead?.name}</td>
                                    <td className="px-4 py-2">{p.status}</td>
                                    <td className="px-4 py-2">
                                        {p.products.map((prod) => (
                                            <div key={prod.id}>{prod.name}</div>
                                        ))}
                                    </td>
                                    <td className="px-4 py-2">
                                        {p.products.reduce((sum, prod) => sum + parseFloat(prod.pivot.harga_nego), 0)}
                                    </td>
                                    <td className="px-4 py-2">{p.created_at}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
