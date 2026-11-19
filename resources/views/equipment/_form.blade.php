@php
    $item = $equipment ?? null;
@endphp

<div class="mb-4">
    <label for="equipment_name" class="block text-sm font-medium text-slate-700">Equipment Name</label>
    <input id="equipment_name" name="equipment_name" type="text" value="{{ old('equipment_name', $item->equipment_name ?? '') }}" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-indigo-400" required>
    @error('equipment_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label for="category" class="block text-sm font-medium text-slate-700">Category</label>
    <select id="category" name="category" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-indigo-400" required>
        <option value="">Select category</option>
        @foreach(\App\Models\Equipment::CATEGORIES as $category)
            <option value="{{ $category }}" @selected(old('category', $item->category ?? '') === $category)>{{ ucfirst($category) }}</option>
        @endforeach
    </select>
    @error('category')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label for="unit_price" class="block text-sm font-medium text-slate-700">Unit Price</label>
    <input id="unit_price" name="unit_price" type="number" step="0.01" min="0" value="{{ old('unit_price', $item->unit_price ?? '') }}" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-indigo-400" required>
    @error('unit_price')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
    <textarea id="description" name="description" rows="5" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 text-sm outline-none focus:border-indigo-400" required>{{ old('description', $item->description ?? '') }}</textarea>
    @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>

<div class="mb-4">
    <label for="availability_status" class="block text-sm font-medium text-slate-700">Availability Status</label>
    <select id="availability_status" name="availability_status" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-indigo-400" required>
        <option value="">Select status</option>
        @foreach(\App\Models\Equipment::STATUSES as $status)
            <option value="{{ $status }}" @selected(old('availability_status', $item->availability_status ?? '') === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
    @error('availability_status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
