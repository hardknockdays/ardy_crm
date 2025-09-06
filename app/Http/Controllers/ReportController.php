<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectsExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start_date');
        $end   = $request->input('end_date');

        $query = Project::with(['lead', 'products']);

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        $projects = $query->orderBy('created_at', 'desc')->get();

        return Inertia::render('Reports/Index', [
            'projects'   => $projects,
            'start_date' => $start,
            'end_date'   => $end,
        ]);
    }

    public function export(Request $request)
    {
        $start = $request->input('start_date');
        $end   = $request->input('end_date');

        return Excel::download(new ProjectsExport($start, $end), 'projects_report.xlsx');
    }
}
