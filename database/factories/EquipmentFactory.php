<?php

namespace Database\Factories;

use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipmentTypes = [
            ['name' => 'Microscope', 'category' => 'Analytical', 'brand' => 'Olympus', 'risk' => 'low'],
            ['name' => 'Centrifuge', 'category' => 'Separation', 'brand' => 'Eppendorf', 'risk' => 'medium'],
            ['name' => 'Spectrophotometer', 'category' => 'Analytical', 'brand' => 'Thermo Scientific', 'risk' => 'low'],
            ['name' => 'Autoclave', 'category' => 'Sterilization', 'brand' => 'Tuttnauer', 'risk' => 'high'],
            ['name' => 'pH Meter', 'category' => 'Measurement', 'brand' => 'Hanna Instruments', 'risk' => 'low'],
            ['name' => 'Rotary Evaporator', 'category' => 'Separation', 'brand' => 'Buchi', 'risk' => 'medium'],
            ['name' => 'HPLC System', 'category' => 'Chromatography', 'brand' => 'Agilent', 'risk' => 'high'],
            ['name' => 'GC-MS System', 'category' => 'Chromatography', 'brand' => 'Shimadzu', 'risk' => 'high'],
            ['name' => 'Balance', 'category' => 'Measurement', 'brand' => 'Mettler Toledo', 'risk' => 'low'],
            ['name' => 'Fume Hood', 'category' => 'Safety', 'brand' => 'Labconco', 'risk' => 'medium'],
            ['name' => 'Hot Plate', 'category' => 'Heating', 'brand' => 'IKA', 'risk' => 'medium'],
            ['name' => 'Magnetic Stirrer', 'category' => 'Mixing', 'brand' => 'IKA', 'risk' => 'low'],
        ];

        $equipment = $this->faker->randomElement($equipmentTypes);

        return [
            'name' => $equipment['name'] . ' ' . $this->faker->bothify('##??'),
            'code' => 'EQ-' . $this->faker->unique()->randomNumber(6),
            'brand' => $equipment['brand'],
            'model' => $this->faker->bothify('Model-##??'),
            'serial_number' => $this->faker->bothify('SN###??####'),
            'category' => $equipment['category'],
            'description' => $this->faker->text(150),
            'technical_specifications' => [
                'power' => $this->faker->randomElement(['220V', '110V', '12V']),
                'weight' => $this->faker->numberBetween(1, 100) . ' kg',
                'dimensions' => $this->faker->numberBetween(20, 100) . 'x' . $this->faker->numberBetween(20, 80) . 'x' . $this->faker->numberBetween(15, 60) . ' cm',
            ],
            'images' => [
                'https://via.placeholder.com/400x300?text=' . urlencode($equipment['name']),
            ],
            'manuals' => [
                'manuals/' . strtolower(str_replace(' ', '-', $equipment['name'])) . '-manual.pdf',
            ],
            'msds_documents' => $equipment['risk'] === 'high' ? [
                'msds/' . strtolower(str_replace(' ', '-', $equipment['name'])) . '-msds.pdf',
            ] : null,
            'risk_level' => $equipment['risk'],
            'requires_supervisor' => $equipment['risk'] === 'high',
            'status' => $this->faker->randomElement(['available', 'available', 'available', 'borrowed', 'maintenance']),
            'location' => 'Shelf ' . $this->faker->randomElement(['A', 'B', 'C']) . '-' . $this->faker->numberBetween(1, 10),
            'purchase_date' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'purchase_price' => $this->faker->numberBetween(500, 50000),
            'last_calibration' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'next_calibration' => $this->faker->dateTimeBetween('now', '+1 year'),
            'last_maintenance' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'next_maintenance' => $this->faker->dateTimeBetween('now', '+6 months'),
            'usage_notes' => $this->faker->optional()->text(100),
            'tags' => $this->faker->randomElements(['precision', 'high-accuracy', 'portable', 'automated', 'digital'], $this->faker->numberBetween(0, 3)),
            'qr_code' => 'QR-' . $this->faker->unique()->randomNumber(8),
            'laboratory_id' => Laboratory::factory(),
        ];
    }

    /**
     * Indicate that the equipment is available.
     */
    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'available',
        ]);
    }

    /**
     * Indicate that the equipment is high risk.
     */
    public function highRisk(): static
    {
        return $this->state(fn (array $attributes) => [
            'risk_level' => 'high',
            'requires_supervisor' => true,
        ]);
    }
}