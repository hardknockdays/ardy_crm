<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $query = Project::with(['lead', 'sales'])->orderBy('created_at', 'desc');

        if (Auth::user()->role !== 'manager') {
            $query->where('sales_id', Auth::id());
        }

        return Inertia::render('Projects/Index', [
            'projects' => $query->paginate(10),
        ]);
    }

    /*public function create()
    {
        return Inertia::render('Projects/Create', [
            'leads' => Lead::all(),
        ]);
    }*/
    
    public function create()
    {
        $leads = Lead::all();
        $products = Product::all()->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'harga_jual' => $p->hpp + ($p->hpp * $p->margin / 100),
            ];
        });

        return Inertia::render('Projects/Create', [
            'leads' => $leads,
            'products' => $products,
        ]);
    }

    /*public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'lead_id' => 'required|exists:customers,id',
            'description' => 'nullable|string',
            'status'      => 'in:new,in_progress,done,cancelled',
        ]);

        $data['sales_id'] = Auth::id();

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan');
    }*/

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.harga_nego' => 'nullable|numeric',
        ]);

        $project = Project::create([
            'lead_id' => $validated['lead_id'],
            'status'  => 'approved', // default            
            'sales_id' => Auth::id(), // ✅ fix error
        ]);

        $needsApproval = false;

        foreach ($validated['products'] as $item) {
            $product = Product::find($item['product_id']);
            $hargaJual = $product->hpp + ($product->hpp * $product->margin / 100);
            $hargaNego = $item['harga_nego'] ?? $hargaJual;

            if ($hargaNego < $hargaJual) {
                $needsApproval = true;
            }

            $project->products()->attach($product->id, [
                'harga_jual' => $hargaJual,
                'harga_nego' => $hargaNego,
            ]);
        }

        if ($needsApproval) {
            $project->update(['status' => 'waiting_approval']);
        }

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        if (Auth::user()->role !== 'manager' && $project->sales_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('Projects/Edit', [
            'project'   => $project,
            'products' => $project->products,
            'leads' => Lead::all(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        if (Auth::user()->role !== 'manager' && $project->sales_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'status' => 'required|string|in:waiting_approval,approved,rejected,ongoing,done',
        ]);

        // ✅ kalau status berubah jadi approved, buat customer
        if ($project->status === 'approved') {
            $this->convertToCustomer($project);
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui');
    }

    public function destroy(Project $project)
    {
        if (Auth::user()->role !== 'manager' && $project->sales_id !== Auth::id()) {
            abort(403);
        }

        $project->deleted_by = Auth::id();
        $project->save();
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus');
    }

    private function convertToCustomer(Project $project)
    {
        $lead = $project->lead;
        $customer = Customer::firstOrCreate(
            ['lead_id' => $lead->id],
            [
                'name' => $lead->name,
                'contact' => $lead->contact,
                'address' => $lead->address,
                'sales_id' => $project->sales_id,
            ]
        );

        foreach ($project->products as $p) {
            $customer->products()->syncWithoutDetaching([
                $p->id => ['harga_nego' => $p->pivot->harga_nego],
            ]);
        }
    }

}
