import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Edit({ lead }) {
    const { data, setData, put, processing, errors } = useForm({
        name: lead.name || '',
        contact: lead.contact || '',
        address: lead.address || '',
        needs: lead.needs || '',
        status: lead.status || 'new',
    });

    const submit = (e) => {
        e.preventDefault();
        put(route('leads.update', lead.id));
    };

    return (
        <AuthenticatedLayout header={<h2 className="text-xl font-semibold">Edit Lead</h2>}>
            <Head title="Edit Lead" />
            <div className="py-6 max-w-4xl mx-auto">
                <form onSubmit={submit} className="bg-white p-6 shadow rounded">
                    <div className="mb-4">
                        <label className="block">Nama</label>
                        <input type="text" value={data.name} onChange={e => setData('name', e.target.value)}
                            className="border rounded w-full p-2" />
                        {errors.name && <div className="text-red-600">{errors.name}</div>}
                    </div>
                    <div className="mb-4">
                        <label className="block">Kontak</label>
                        <input type="text" value={data.contact} onChange={e => setData('contact', e.target.value)}
                            className="border rounded w-full p-2" />
                    </div>
                    <div className="mb-4">
                        <label className="block">Alamat</label>
                        <input type="text" value={data.address} onChange={e => setData('address', e.target.value)}
                            className="border rounded w-full p-2" />
                    </div>
                    <div className="mb-4">
                        <label className="block">Kebutuhan</label>
                        <input type="text" value={data.needs} onChange={e => setData('needs', e.target.value)}
                            className="border rounded w-full p-2" />
                    </div>
                    <div className="mb-4">
                        <label className="block">Status</label>
                        <select value={data.status} onChange={e => setData('status', e.target.value)}
                            className="border rounded w-full p-2">
                            <option value="new">New</option>
                            <option value="contacted">Contacted</option>
                            <option value="qualified">Qualified</option>
                            <option value="lost">Lost</option>
                        </select>
                    </div>

                    <div className="flex justify-between">
                        <Link href={route('leads.index')} className="px-4 py-2 bg-gray-500 text-white rounded">Kembali</Link>
                        <button type="submit" disabled={processing}
                            className="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
