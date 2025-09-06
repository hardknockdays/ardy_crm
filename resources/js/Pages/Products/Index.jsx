import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';

export default function ProductsIndex({ products }) {
    const handleDelete = (id) => {
        if (confirm("Yakin mau hapus produk ini?")) {
            router.delete(route("products.destroy", id));
        }
    };

    return (
        <AuthenticatedLayout
            header={<h2 className="text-2xl font-bold text-gray-900">Products</h2>}
        >
            <Head title="Products" />

            <div className="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white shadow rounded-xl p-6">
                    <div className="flex justify-between items-center mb-6">
                        <h3 className="text-lg font-semibold text-gray-700">Daftar Produk</h3>
                        <Link
                            href={route("products.create")}
                            className="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow hover:bg-green-700 transition"
                        >
                            + Tambah Produk
                        </Link>
                    </div>

                    <div className="overflow-x-auto border rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200 text-sm">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-4 py-3 text-left font-medium text-gray-600">Nama</th>
                                    <th className="px-4 py-3 text-right font-medium text-gray-600">HPP</th>
                                    <th className="px-4 py-3 text-right font-medium text-gray-600">Margin (%)</th>
                                    <th className="px-4 py-3 text-right font-medium text-gray-600">Harga Jual</th>
                                    <th className="px-4 py-3 text-center font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {products.data.length > 0 ? (
                                    products.data.map((product) => (
                                        <tr key={product.id} className="hover:bg-gray-50">
                                            <td className="px-4 py-3">{product.name}</td>
                                            <td className="px-4 py-3 text-right">Rp {Number(product.hpp).toLocaleString()}</td>
                                            <td className="px-4 py-3 text-right">{product.margin} %</td>
                                            <td className="px-4 py-3 text-right">Rp {Number(product.price).toLocaleString()}</td>
                                            <td className="px-4 py-3 text-center space-x-2">
                                                <Link
                                                    href={route("products.edit", product.id)}
                                                    className="inline-flex px-3 py-1 bg-amber-500 text-white text-xs font-semibold rounded-md hover:bg-amber-600 transition"
                                                >
                                                    Edit
                                                </Link>
                                                <button
                                                    onClick={() => handleDelete(product.id)}
                                                    className="inline-flex px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition"
                                                >
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="5" className="px-4 py-6 text-center text-gray-500">
                                            Belum ada produk.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    <div className="mt-6 flex justify-center space-x-1">
                        {products.links.map((link, index) => (
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
