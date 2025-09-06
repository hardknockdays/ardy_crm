import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';

export default function Create({ leads }) {
    const { data, setData, post, processing, errors } = useForm({
        lead_id: '',
        status: 'waiting_approval',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('projects.store'));
    };

    return (
        <AuthenticatedLayout header={<h2 className="text-2xl font-bold">Tambah Project</h2>}>
            <Head title="Tambah Project" />

            <div className="max-w-2xl mx-auto py-6">
                <form onSubmit={submit} className="bg-white shadow rounded-xl p-6 space-y-4">
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

                    <div>
                        <label className="block text-sm font-medium text-gray-700">Status</label>
                        <select
                            value={data.status}
                            onChange={(e) => setData('status', e.target.value)}
                            className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="waiting_approval">Waiting Approval</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="done">Done</option>
                        </select>
                        {errors.status && <p className="text-red-500 text-xs">{errors.status}</p>}
                    </div>

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
