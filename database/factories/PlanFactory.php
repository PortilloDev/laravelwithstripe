<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => 'Mensual',
            'slug'        => 'mensual',
            'stripe_plan' => 'Mensual',
            'cost'        => 19.99, 
            'description' => 'Acceso por un mes a toda la biblioteca'
          
        ];
    }
}
