<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *w
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'national_id'=>$this->faker->unique()->randomNumber(),
            'mail' => 'mahmoud.hussiba@gmail.com',
            'sub_end_date'=>now()->subDay(1),
        ];
    }
}
