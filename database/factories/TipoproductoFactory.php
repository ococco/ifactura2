<?php

namespace Database\Factories;

use App\Models\Tipoproducto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoproductoFactory extends Factory
{
    protected $model = Tipoproducto::class;

    public function definition()
    {
        return [
			'descripion' => $this->faker->name,
        ];
    }
}
