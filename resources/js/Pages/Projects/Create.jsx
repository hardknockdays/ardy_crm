import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import { useState } from 'react';

export default function Create({ leads, products }) {
    const { data, setData, post, processing, errors } = useForm({
        lead_id: '',
        products: [], // array of { product_id, harga_nego }
    });

    // Tambah produk kosong
    const addProduct = () => {
        setData('products', [
            ...data.products,
            { product_id: '', harga_nego: '' },
        ]);
    };

    // Hapus produk
    const removeProduct = (index) => {
        const newProducts = [...data.products];
        newProducts.splice(index, 1);
        setData('products', newProducts);
    };

    // Update product field
    const updateProduct = (index, field, value) => {
        const newProducts = [...data.products];
        newProducts[index][field] = value;
        setData('products', newProducts);
    };

    const submit = (e) => {
        e.preventDefault();
        post(route('projects.store'));
    };

    return (
        <AuthenticatedLayout header={<h2 className="text-2xl font-bold">Tambah Project</h2>}>
            <Head title="Tambah Project" />

            <div className="max-w-4xl mx-auto py-6">
                <form onSubmit={submit} className="bg-white shadow rounded-xl p-6 space-y-6">

                    {/* Lead */}
                    <div>
                        <label className="block text-sm font-medium text-gray-700">Lead</label>
                        <select
                            value={data.lead_id}
                            onChange={(e) => setData('lead_id', e.target.value)}
                            className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">-- Pilih Lead --</option>
                            {leads.map((lead) => (
                                <option key={lead.id} value={lead.id}>
                                    {lead.name}
                                </option>
                            ))}
                        </select>
                        {errors.lead_id && <p className="text-red-500 text-xs">{errors.lead_id}</p>}
                    </div>

                    {/* Produk */}
                    <div>
                        <div className="flex justify-between items-center mb-2">
                            <label className="block text-sm font-medium text-gray-700">Produk</label>
                            <button
                                type="button"
                                onClick={addProduct}
                                className="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700"
                            >
                                + Tambah Produk
                            </button>
                        </div>

                        {data.products.length === 0 && (
                            <p className="text-gray-500 text-sm">Belum ada produk ditambahkan.</p>
                        )}

                        {data.products.map((p, index) => (
                            <div key={index} className="flex items-center gap-3 mb-3">
                                <select
                                    value={p.product_id}
                                    onChange={(e) => updateProduct(index, 'product_id', e.target.value)}
                                    className="flex-1 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">-- Pilih Produk --</option>
                                    {products.map((prod) => (
                                        <option key={prod.id} value={prod.id}>
                                            {prod.name} (Rp {prod.harga_jual})
                                        </option>
                                    ))}
                                </select>

                                <input
                                    type="number"
                                    placeholder="Harga nego"
                                    value={p.harga_nego}
                                    onChange={(e) => updateProduct(index, 'harga_nego', e.target.value)}
                                    className="w-40 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                />

                                <button
                                    type="button"
                                    onClick={() => removeProduct(index)}
                                    className="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                >
                                    Hapus
                                </button>
                            </div>
                        ))}

                        {errors.products && <p className="text-red-500 text-xs">{errors.products}</p>}
                    </div>

                    {/* Actions */}
                    <div className="flex justify-between">
                        <Link
                            href={route('projects.index')}
                            className="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                        >
                            Batal
                        </Link>
                        <button
                            type="submit"
                            disabled={processing}
                            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
