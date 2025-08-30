<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\WebPortal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriptions>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'status' => rand(0,1),
            'email_verify_token' => Str::random(32),
            'email_verified_at' => now(),
            'portal_id' => WebPortal::factory(),
        ];
    }
}
