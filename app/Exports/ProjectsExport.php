<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{
    protected $start, $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    public function collection()
    {
        $query = Project::with(['lead', 'products']);

        if ($this->start && $this->end) {
            $query->whereBetween('created_at', [$this->start, $this->end]);
        }

        return $query->get()->map(function ($p) {
            return [
                'ID' => $p->id,
                'Lead' => $p->lead->name ?? '-',
                'Status' => $p->status,
                'Produk' => $p->products->pluck('name')->join(', '),
                'Total Nego' => $p->products->sum(fn($prod) => $prod->pivot->harga_nego),
                'Tanggal' => $p->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Lead', 'Status', 'Produk', 'Total Nego', 'Tanggal'];
    }
}
