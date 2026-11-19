@extends('layouts.admin')

@section('title', 'Edit Equipment')

@section('content')
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
        <div>
            <p class="text-sm text-slate-400">Inventory</p>
            <h1 class="mt-1 text-lg font-bold text-slate-900">Edit Equipment</h1>
        </div>
        <a href="{{ route('equipment.show', $equipment) }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">View Details</a>
    </div>

    <form method="POST" action="{{ route('equipment.update', $equipment) }}" class="p-6">
        @csrf
        @method('PUT')
        @include('equipment._form', ['equipment' => $equipment])
        <div class="mt-6 flex gap-3 border-t border-slate-100 pt-5">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Update Equipment</button>
            <a href="{{ route('equipment.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>
@endsection
