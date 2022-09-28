<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {

    $base  = $this->faker->randomFloat(2,100,1000);
    $tax   = $base * 0.10;
    $total = $base + $tax;
    return [
      'serie' => $this->faker->randomElement(['F001','B001']),
      'base' => $base,
      'tax' => $tax,
      'total' => $total,
      'user_id' => User::all()->random()->id,
    ];
  }
}
