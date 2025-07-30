<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentType = $this->faker->randomElement(['كاش', 'قسط']);

        return [
            'user_id'    => User::first()->id,
            'title'      => $this->faker->sentence(4),
            'brief'      => $this->faker->paragraph,
            'type' => $this->faker->randomElement([
                'شقق',
                'محلات',
                'اراضى',
                'ارضى',
                'ارضى بجنينة',
                'ادارى',
                'مبانى',
                'روف',
                'فيلا',
                'سكن الطلبة',
                'شقق مصيفية',
                'شاليهات',
            ]),
            'purpose'    => $this->faker->randomElement(['بيع', 'شراء', 'ايجار']),
            'gov'        => 1,
            'area'       => $this->faker->streetName,
            'level' => $this->faker->numberBetween(1, 10),
            'rooms'      => $this->faker->numberBetween(1, 5),
            'meters'     => $this->faker->numberBetween(50, 500),
            'payment'    => $paymentType,
            'price'      => $paymentType === 'كاش' ? $this->faker->numberBetween(100000, 1000000) : null,
            'presenter'  => $paymentType === 'قسط' ? $this->faker->numberBetween(100, 9999) : null,
            'seen'       => $this->faker->numberBetween(0, 100),
            'is_special' => $this->faker->boolean,
            'created_at' => now(),
        ];
    }
}
