<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\WebPortal;
use App\Models\Subscription;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebPortal>
 */
class WebPortalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portal_name' => fake()->unique()->safeEmail(),
            'status' => rand(0,1),
            'secret_key' => Str::random(64),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (WebPortal $webPortal) {
            Subscription::factory()->count(2)->create([
                'portal_id' => $webPortal->id,
            ]);
        });
    }    
}
