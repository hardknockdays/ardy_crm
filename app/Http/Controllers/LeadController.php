<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    // GET /api/leads
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'manager') {
            $leads = Lead::all();
        } else {
            $leads = Lead::where('sales_id', $user->id)->get();
        }

        return response()->json($leads);
    }

    // POST /api/leads
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'needs'   => 'nullable|string',
            'status'  => 'in:new,contacted,qualified,lost'
        ]);

        $data['sales_id'] = Auth::id();

        $lead = Lead::create($data);

        return response()->json($lead, 201);
    }

    // GET /api/leads/{id}
    public function show(Lead $lead)
    {
        $this->authorizeLead($lead);

        return response()->json($lead);
    }

    // PUT /api/leads/{id}
    public function update(Request $request, Lead $lead)
    {
        $this->authorizeLead($lead);

        $data = $request->validate([
            'name'    => 'string|max:100',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'needs'   => 'nullable|string',
            'status'  => 'in:new,contacted,qualified,lost'
        ]);

        $lead->update($data);

        return response()->json($lead);
    }

    // DELETE /api/leads/{id}
    public function destroy(Lead $lead)
    {
        $this->authorizeLead($lead);

        $lead->delete();

        return response()->json(['message' => 'Lead deleted successfully']);
    }

    private function authorizeLead(Lead $lead)
    {
        $user = Auth::user();

        if ($user->role !== 'manager' && $lead->sales_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }
}
