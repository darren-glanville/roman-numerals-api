<?php

namespace Database\Factories;

use App\Models\RomanNumeral;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\RomanNumeralConverter;

class RomanNumeralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RomanNumeral::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $integer = $this->faker->numberBetween($min = 1, $max = 30);

        $converter = new RomanNumeralConverter;
        $result = $converter->convertInteger($integer);

        return [
            'original' => $integer,
            'converted' => $result,
            'processed' => $this->faker->dateTimeThisCentury($max = 'now', 'UTC')
        ];
    }
}
