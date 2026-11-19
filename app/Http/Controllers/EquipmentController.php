<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    public function index(): View
    {
        $equipment = Equipment::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('equipment.index', compact('equipment'));
    }

    public function create(): View
    {
        return view('equipment.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        // Never accept user_id from the form; it is always the logged-in owner.
        Equipment::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment record added successfully.');
    }

    public function show(Equipment $equipment): View
    {
        $this->authorizeOwner($equipment);

        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment): View
    {
        $this->authorizeOwner($equipment);

        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment): RedirectResponse
    {
        $this->authorizeOwner($equipment);
        $validated = $request->validate($this->rules());

        $equipment->update($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment record updated successfully.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        $this->authorizeOwner($equipment);
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment record deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'equipment_name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(Equipment::CATEGORIES)],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'availability_status' => ['required', Rule::in(Equipment::STATUSES)],
        ];
    }

    private function authorizeOwner(Equipment $equipment): void
    {
        abort_unless($equipment->user_id === auth()->id(), 404);
    }
}