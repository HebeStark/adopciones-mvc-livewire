<?php

namespace Database\Factories;

use App\Enums\AnimalType;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        $tipo = $this->faker->randomElement(AnimalType::values());

        return [
            'nombre' => $this->faker->firstName(),
            'tipo'   => $tipo,
            'edad'   => $this->faker->numberBetween(1, 12),
            'estado' => 'disponible',
            'foto'   => null,
        ];
    }

    public function cachorro(): static
    {
        return $this->state(fn (array $_) => [
            'edad' => $this->faker->numberBetween(0, 1),
        ]);
    }

    public function perro(): static
    {
        return $this->state(fn (array $_) => [
            'tipo' => AnimalType::Perro->value,
        ]);
    }

    public function gato(): static
    {
        return $this->state(fn (array $_) => [
            'tipo' => AnimalType::Gato->value,
        ]);
    }
}
