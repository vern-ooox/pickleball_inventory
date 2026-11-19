@extends('layouts.admin')

@section('title', 'Equipment Details')

@section('content')
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
        <div>
            <p class="text-sm text-slate-400">Inventory / Equipment Details</p>
            <h1 class="mt-1 text-lg font-bold text-slate-900">{{ $equipment->equipment_name }}</h1>
        </div>
        <a href="{{ route('equipment.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Back to Inventory</a>
    </div>

    <div class="p-6">
        <dl class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="border-b border-slate-100 pb-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Category</dt>
                <dd class="mt-2 text-sm font-semibold text-slate-700">{{ ucfirst($equipment->category) }}</dd>
            </div>
            <div class="border-b border-slate-100 pb-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Unit Price</dt>
                <dd class="mt-2 text-sm font-semibold text-slate-700">₱{{ number_format($equipment->unit_price, 2) }}</dd>
            </div>
            <div class="border-b border-slate-100 pb-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Availability Status</dt>
                <dd class="mt-2">
                    @if($equipment->availability_status === 'available')
                        <span class="text-sm font-medium text-emerald-600">● In stock</span>
                    @else
                        <span class="text-sm font-medium text-rose-600">● Out of stock</span>
                    @endif
                </dd>
            </div>
            <div class="border-b border-slate-100 pb-4 md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Description</dt>
                <dd class="mt-2 text-sm leading-6 text-slate-700">{{ $equipment->description }}</dd>
            </div>
        </dl>
        <div class="mt-6 flex gap-3 border-t border-slate-100 pt-5">
            <a href="{{ route('equipment.edit', $equipment) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Edit Equipment</a>
            <a href="{{ route('equipment.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Back to Inventory</a>
        </div>
    </div>
</div>
@endsection
