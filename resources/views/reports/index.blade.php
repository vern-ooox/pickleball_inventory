@extends('layouts.admin')

@section('title', 'Equipment Reports')

@section('content')
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-5">
        <div>
            <p class="text-sm text-slate-400">Inventory / Reports</p>
            <h1 class="mt-1 text-lg font-bold text-slate-900">Equipment Reports</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('reports.pdf', request()->query()) }}" class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 hover:bg-slate-50">PDF</a>
            <a href="{{ route('reports.excel', request()->query()) }}" class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 hover:bg-slate-50">Export Excel</a>
        </div>
    </div>

    <form method="GET" action="{{ route('reports.index') }}" class="border-b border-slate-100 px-6 py-5">
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label for="report" class="block text-sm font-medium text-slate-700">Report</label>
                <select id="report" name="report" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm">
                    @foreach(\App\Http\Controllers\ReportController::REPORTS as $value => $label)
                        <option value="{{ $value }}" @selected(request('report', 'price_list') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-slate-700">Category</label>
                <select id="category" name="category" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm">
                    <option value="">All categories</option>
                    @foreach(\App\Models\Equipment::CATEGORIES as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="availability_status" class="block text-sm font-medium text-slate-700">Availability</label>
                <select id="availability_status" name="availability_status" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm">
                    <option value="">All statuses</option>
                    @foreach(\App\Models\Equipment::STATUSES as $status)
                        <option value="{{ $status }}" @selected(request('availability_status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-4 flex gap-3">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Apply Filters</button>
            <a href="{{ route('reports.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Reset Filters</a>
        </div>
    </form>

    <div class="px-6 py-5">
        <h2 class="mb-4 text-sm font-semibold text-slate-700">{{ $title }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-xs text-slate-400">
                        <th class="px-3 py-3 text-left font-medium">Equipment Name</th>
                        <th class="px-3 py-3 text-left font-medium">Category</th>
                        <th class="px-3 py-3 text-right font-medium">Unit Price</th>
                        <th class="px-3 py-3 text-left font-medium">Availability</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="px-3 py-4 font-semibold text-slate-700">{{ $item->equipment_name }}</td>
                        <td class="px-3 py-4 text-slate-500">{{ ucfirst($item->category) }}</td>
                        <td class="px-3 py-4 text-right font-medium text-slate-700">₱{{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-3 py-4">
                            @if($item->availability_status === 'available')
                                <span class="text-xs font-medium text-emerald-600">● In stock</span>
                            @else
                                <span class="text-xs font-medium text-rose-600">● Out of stock</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-3 py-10 text-center text-slate-400">No equipment records match the selected filters.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
