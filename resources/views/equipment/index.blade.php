@extends('layouts.admin')

@section('title', 'Equipment Inventory')

@section('content')
@php
    $totalValue = $equipment->sum('unit_price');
    $availableCount = $equipment->where('availability_status', 'available')->count();
    $unavailableCount = $equipment->where('availability_status', 'unavailable')->count();
@endphp

<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-5">
        <h1 class="text-lg font-bold text-slate-900">Inventory</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('reports.pdf') }}" class="inline-flex h-10 items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 5-5m-5 5-5-5M5 21h14"/></svg>
                PDF
            </a>
            <a href="{{ route('reports.excel') }}" class="inline-flex h-10 items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>
                Export
            </a>
            <a href="{{ route('equipment.create') }}" class="inline-flex h-10 items-center gap-2 rounded-lg bg-indigo-600 px-4 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                <span class="text-lg leading-none">+</span>
                Add Equipment
            </a>
        </div>
    </div>

    <div class="grid gap-0 border-b border-slate-100 lg:grid-cols-[280px_1fr]">
        <div class="border-b border-slate-100 px-6 py-6 lg:border-b-0 lg:border-r">
            <p class="text-sm text-slate-400">Total Asset Value</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">₱{{ number_format($totalValue, 0) }}</p>
        </div>
        <div class="flex items-center px-6 py-6">
            <div class="w-full">
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-slate-900">{{ $equipment->count() }}</span>
                    <span class="text-sm text-slate-500">Equipment</span>
                </div>
                <div class="mt-3 flex h-2 overflow-hidden rounded-full bg-slate-100">
                    @if($equipment->count())
                        <span class="bg-emerald-500" style="width: {{ ($availableCount / $equipment->count()) * 100 }}%"></span>
                        <span class="bg-rose-500" style="width: {{ ($unavailableCount / $equipment->count()) * 100 }}%"></span>
                    @endif
                </div>
                <div class="mt-2 flex flex-wrap gap-5 text-xs">
                    <span class="text-emerald-600">● Available: {{ $availableCount }}</span>
                    <span class="text-rose-600">● Unavailable: {{ $unavailableCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 py-5">
        <div class="mb-4 flex flex-wrap items-center gap-3">
            <div class="relative min-w-[220px] flex-1">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input id="equipment-search" type="search" placeholder="Search equipment" class="h-10 w-full rounded-lg border border-slate-200 pl-10 pr-3 text-sm outline-none focus:border-indigo-400">
            </div>
            <a href="{{ route('reports.index') }}" class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-4 text-sm font-medium text-slate-600 hover:bg-slate-50">Filter</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-xs text-slate-400">
                        <th class="px-3 py-3 text-left font-medium">Equipment Name</th>
                        <th class="px-3 py-3 text-left font-medium">Category</th>
                        <th class="px-3 py-3 text-left font-medium">Availability</th>
                        <th class="px-3 py-3 text-right font-medium">Price</th>
                        <th class="w-16 px-3 py-3 text-right font-medium">Action</th>
                    </tr>
                </thead>
                <tbody id="equipment-table-body">
                @forelse($equipment as $item)
                    <tr class="equipment-row border-b border-slate-100 hover:bg-slate-50" data-search="{{ strtolower($item->equipment_name.' '.$item->category.' '.$item->availability_status) }}">
                        <td class="px-3 py-4">
                            <a href="{{ route('equipment.show', $item) }}" class="font-semibold text-slate-700 hover:text-indigo-600">{{ $item->equipment_name }}</a>
                        </td>
                        <td class="px-3 py-4 text-slate-500">{{ ucfirst($item->category) }}</td>
                        <td class="px-3 py-4">
                            @if($item->availability_status === 'available')
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600"><span>●</span> In stock</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-rose-600"><span>●</span> Out of stock</span>
                            @endif
                        </td>
                        <td class="px-3 py-4 text-right font-medium text-slate-700">₱{{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-3 py-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('equipment.edit', $item) }}" class="text-slate-400 hover:text-indigo-600" title="Edit">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('equipment.destroy', $item) }}" onsubmit="return confirm('Delete this equipment record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-600" title="Delete">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 10v6M14 10v6"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-3 py-10 text-center text-slate-400">No equipment records found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('equipment-search')?.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        document.querySelectorAll('.equipment-row').forEach(function (row) {
            row.hidden = query !== '' && !row.dataset.search.includes(query);
        });
    });
</script>
@endsection
