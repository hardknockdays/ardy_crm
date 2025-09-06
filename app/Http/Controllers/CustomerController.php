<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $query = Customer::with('products');

        if (auth()->user()->role !== 'manager') {
            $query->where('sales_id', auth()->id());
        }

        return Inertia::render('Customers/Index', [
            'customers' => $query->paginate(10),
        ]);
    }

}
