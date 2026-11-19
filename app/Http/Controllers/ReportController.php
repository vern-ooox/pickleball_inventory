<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExports;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public const REPORTS = [
        'available' => 'Available Equipment',
        'unavailable' => 'Unavailable Equipment',
        'category' => 'Equipment by Category',
        'price_list' => 'Equipment Price List',
    ];

    public function index(Request $request)
    {
        [$items, $title] = $this->getReport($request);

        return view('reports.index', compact('items', 'title'));
    }

    public function exportPdf(Request $request)
    {
        [$items, $title] = $this->getReport($request);

        return Pdf::loadView('reports.pdf', compact('items', 'title'))
            ->download('equipment-report.pdf');
    }

    public function exportExcel(Request $request)
    {
        [$items] = $this->getReport($request);

        return Excel::download(new EquipmentExports($items), 'equipment-report.xlsx');
    }

    // One query is used by the page AND both exports, so exports always match the filters
    private function getReport(Request $request): array
    {
        $request->validate([
            'report' => ['nullable', Rule::in(array_keys(self::REPORTS))],
            'category' => ['nullable', Rule::in(Equipment::CATEGORIES)],
            'availability_status' => ['nullable', Rule::in(Equipment::STATUSES)],
        ]);

        $report = $request->input('report', 'price_list');
        $category = $request->input('category');
        $status = $request->input('availability_status');

        // The two status reports force their own status; the other reports use the dropdown
        if ($report === 'available') {
            $status = 'available';
        }
        if ($report === 'unavailable') {
            $status = 'unavailable';
        }

        // Category and status filters are chained, so they work together
        $items = Equipment::query()
            ->where('user_id', auth()->id())
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($status, fn ($q) => $q->where('availability_status', $status))
            ->orderBy('equipment_name')
            ->get();

        return [$items, self::REPORTS[$report]];
    }
}