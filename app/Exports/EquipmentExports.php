<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EquipmentExports implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Collection $items)
    {
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return ['Equipment Name', 'Category', 'Unit Price', 'Availability Status'];
    }

    public function map($item): array
    {
        return [
            $item->equipment_name,
            ucfirst($item->category),
            $item->unit_price,
            ucfirst($item->availability_status),
        ];
    }
}