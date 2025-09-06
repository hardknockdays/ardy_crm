<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LeadWebController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Lead::query();

        if ($user->role !== 'manager') {
            $query->where('sales_id', $user->id);
        }

        return Inertia::render('Leads/Index', [
            'leads' => $query->orderBy('created_at','desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Leads/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'needs'   => 'nullable|string',
            'status'  => 'in:new,contacted,qualified,lost',
        ]);

        $data['sales_id'] = Auth::id();
        Lead::create($data);

        return redirect()->route('leads.index')->with('success', 'Lead berhasil ditambahkan');
    }

    public function edit(Lead $lead)
    {
        if (Auth::user()->role !== 'manager' && $lead->sales_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('Leads/Edit', [
            'lead' => $lead,
        ]);
    }

    public function update(Request $request, Lead $lead)
    {
        if (Auth::user()->role !== 'manager' && $lead->sales_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'name'    => 'string|max:100',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'needs'   => 'nullable|string',
            'status'  => 'in:new,contacted,qualified,lost',
        ]);

        $lead->update($data);

        return redirect()->route('leads.index')->with('success', 'Lead berhasil diupdate');
    }

    /*
    public function destroy(Lead $lead)
    {
        if (Auth::user()->role !== 'manager' && $lead->sales_id !== Auth::id()) {
            abort(403);
        }

        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead berhasil dihapus');
    }*/
        public function destroy(Lead $lead)
        {
            if (Auth::user()->role !== 'manager' && $lead->sales_id !== Auth::id()) {
                abort(403);
            }

            $lead->deleted_by = Auth::id();   // simpan siapa yg hapus
            $lead->save();

            $lead->delete(); // soft delete

            return redirect()->route('leads.index')->with('success', 'Lead berhasil dihapus');
        }

}
