import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Edit({ product }) {
    const { data, setData, put, processing, errors } = useForm({
        name: product.name || '',
        hpp: product.hpp || 0,
        margin: product.margin || 0,
    });

    const submit = (e) => {
        e.preventDefault();
        put(route('products.update', product.id));
    };

    return (
        <AuthenticatedLayout header={<h2 className="text-2xl font-bold">Edit Produk</h2>}>
            <Head title="Edit Produk" />

            <div className="max-w-2xl mx-auto py-6">
                <form onSubmit={submit} className="bg-white shadow rounded-xl p-6 space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Nama</label>
                        <input
                            type="text"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        {errors.name && <p className="text-red-500 text-xs">{errors.name}</p>}
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700">HPP</label>
                        <input
                            type="number"
                            value={data.hpp}
                            onChange={(e) => setData('hpp', e.target.value)}
                            className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        {errors.hpp && <p className="text-red-500 text-xs">{errors.hpp}</p>}
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700">Margin (%)</label>
                        <input
                            type="number"
                            value={data.margin}
                            onChange={(e) => setData('margin', e.target.value)}
                            className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                        {errors.margin && <p className="text-red-500 text-xs">{errors.margin}</p>}
                    </div>

                    <div className="flex justify-between">
                        <Link
                            href={route('products.index')}
                            className="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                        >
                            Batal
                        </Link>
                        <button
                            type="submit"
                            disabled={processing}
                            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
                        >
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
