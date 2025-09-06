import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, router } from '@inertiajs/react';

export default function LeadsIndex({ leads }) {
    const { delete: destroy } = useForm();

    const handleDelete = (id) => {
        if (confirm("Yakin mau hapus lead ini?")) {
            router.delete(route("leads.destroy", id));
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-2xl font-bold tracking-tight text-gray-900">
                    Leads
                </h2>
            }
        >
            <Head title="Leads" />

            <div className="py-8">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white shadow rounded-2xl p-6">
                        {/* Header */}
                        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                            <h3 className="text-lg font-semibold text-gray-700">
                                Daftar Leads
                            </h3>
                            <Link
                                href={route("leads.create")}
                                className="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-xl shadow hover:bg-blue-700 transition"
                            >
                                + Tambah Lead
                            </Link>
                        </div>

                        {/* Table */}
                        <div className="overflow-x-auto rounded-lg border border-gray-200">
                            <table className="min-w-full divide-y divide-gray-200 text-sm">
                                <thead className="bg-gray-50">
                                    <tr>
                                        <th className="px-4 py-3 text-left font-medium text-gray-600">Nama</th>
                                        <th className="px-4 py-3 text-left font-medium text-gray-600">Kontak</th>
                                        <th className="px-4 py-3 text-left font-medium text-gray-600">Alamat</th>
                                        <th className="px-4 py-3 text-left font-medium text-gray-600">Kebutuhan</th>
                                        <th className="px-4 py-3 text-left font-medium text-gray-600">Status</th>
                                        <th className="px-4 py-3 text-center font-medium text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100">
                                    {leads.data.length > 0 ? (
                                        leads.data.map((lead) => (
                                            <tr key={lead.id} className="hover:bg-gray-50">
                                                <td className="px-4 py-3">{lead.name}</td>
                                                <td className="px-4 py-3">{lead.contact}</td>
                                                <td className="px-4 py-3">{lead.address}</td>
                                                <td className="px-4 py-3">{lead.needs}</td>
                                                <td className="px-4 py-3">
                                                    <span
                                                        className={`px-2 py-1 text-xs font-semibold rounded-full ${
                                                            lead.status === 'new'
                                                                ? 'bg-blue-100 text-blue-600'
                                                                : lead.status === 'contacted'
                                                                ? 'bg-yellow-100 text-yellow-600'
                                                                : lead.status === 'qualified'
                                                                ? 'bg-green-100 text-green-600'
                                                                : 'bg-red-100 text-red-600'
                                                        }`}
                                                    >
                                                        {lead.status}
                                                    </span>
                                                </td>
                                                <td className="px-4 py-3 text-center space-x-2">
                                                    <Link
                                                        href={route("leads.edit", lead.id)}
                                                        className="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-lg hover:bg-yellow-600 transition"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <button
                                                        onClick={() => handleDelete(lead.id)}
                                                        className="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition"
                                                    >
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td
                                                colSpan="6"
                                                className="px-4 py-6 text-center text-gray-500"
                                            >
                                                Belum ada lead.
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>

                        {/* Pagination */}
                        <div className="mt-6 flex justify-center space-x-1">
                            {leads.links.map((link, index) => (
                                <Link
                                    key={index}
                                    href={link.url || "#"}
                                    className={`px-3 py-1 border rounded-lg text-sm ${
                                        link.active
                                            ? "bg-blue-600 text-white border-blue-600"
                                            : "bg-white text-gray-600 hover:bg-gray-100"
                                    }`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
