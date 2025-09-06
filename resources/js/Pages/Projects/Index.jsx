import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';

export default function ProjectsIndex({ projects }) {
    const handleDelete = (id) => {
        if (confirm("Yakin mau hapus project ini?")) {
            router.delete(route("projects.destroy", id));
        }
    };

    return (
        <AuthenticatedLayout
            header={<h2 className="text-2xl font-bold text-gray-900">Projects</h2>}
        >
            <Head title="Projects" />

            <div className="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white shadow rounded-xl p-6">
                    <div className="flex justify-between items-center mb-6">
                        <h3 className="text-lg font-semibold text-gray-700">Daftar Projects</h3>
                        <Link
                            href={route("projects.create")}
                            className="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition"
                        >
                            + Tambah Project
                        </Link>
                    </div>

                    <div className="overflow-x-auto border rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200 text-sm">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-4 py-3 text-left font-medium text-gray-600">Lead</th>
                                    <th className="px-4 py-3 text-left font-medium text-gray-600">Sales</th>
                                    <th className="px-4 py-3 text-left font-medium text-gray-600">Status</th>
                                    <th className="px-4 py-3 text-center font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {projects.data.length > 0 ? (
                                    projects.data.map((project) => (
                                        <tr key={project.id} className="hover:bg-gray-50">
                                            <td className="px-4 py-3">{project.lead?.name}</td>
                                            <td className="px-4 py-3">{project.sales?.name}</td>
                                            <td className="px-4 py-3">
                                                <span
                                                    className={`px-2 py-1 text-xs font-semibold rounded-full ${
                                                        project.status === 'waiting_approval'
                                                            ? 'bg-gray-100 text-gray-600'
                                                            : project.status === 'approved'
                                                            ? 'bg-green-100 text-green-600'
                                                            : project.status === 'rejected'
                                                            ? 'bg-red-100 text-red-600'
                                                            : project.status === 'ongoing'
                                                            ? 'bg-blue-100 text-blue-600'
                                                            : 'bg-indigo-100 text-indigo-600'
                                                    }`}
                                                >
                                                    {project.status}
                                                </span>
                                            </td>
                                            <td className="px-4 py-3 text-center space-x-2">
                                                <Link
                                                    href={route("projects.edit", project.id)}
                                                    className="inline-flex px-3 py-1 bg-amber-500 text-white text-xs font-semibold rounded-md hover:bg-amber-600 transition"
                                                >
                                                    Edit
                                                </Link>
                                                <button
                                                    onClick={() => handleDelete(project.id)}
                                                    className="inline-flex px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition"
                                                >
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="4" className="px-4 py-6 text-center text-gray-500">
                                            Belum ada project.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="mt-6 flex justify-center space-x-1">
                        {projects.links.map((link, index) => (
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
        </AuthenticatedLayout>
    );
}
