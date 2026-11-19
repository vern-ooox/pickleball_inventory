<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $equipment = [
            ['Carbon Fiber Paddle', 'paddles', 129.99, 'Lightweight 16 mm carbon fiber paddle with a comfortable cushioned grip.', 'available'],
            ['Fiberglass Paddle', 'paddles', 89.50, 'Balanced fiberglass paddle with a textured face for controlled spin.', 'unavailable'],
            ['Indoor Pickleball Pack', 'balls', 24.75, 'Pack of six indoor balls with 26 precisely drilled holes.', 'available'],
            ['Outdoor Pickleball Pack', 'balls', 27.95, 'Pack of six durable outdoor balls rated for hard court surfaces.', 'available'],
            ['Portable Pickleball Net', 'nets', 159.00, 'Portable 22-foot net with a regulation-height steel frame and carry bag.', 'available'],
            ['Replacement Net', 'nets', 49.99, 'Weather-resistant replacement mesh net for standard pickleball portable systems.', 'unavailable'],
            ['Paddle Grip Tape', 'accessories', 12.50, 'Pack of three perforated, sweat-absorbent overgrips for paddle handles.', 'available'],
            ['Pickleball Equipment Bag', 'accessories', 39.95, 'Padded zippered bag with compartments for paddles, balls, and accessories.', 'unavailable'],
        ];

        foreach ($equipment as [$name, $category, $price, $description, $status]) {
            Equipment::updateOrCreate(
                ['user_id' => $admin->id, 'equipment_name' => $name],
                [
                    'category' => $category,
                    'unit_price' => $price,
                    'description' => $description,
                    'availability_status' => $status,
                ]
            );
        }
    }
}
