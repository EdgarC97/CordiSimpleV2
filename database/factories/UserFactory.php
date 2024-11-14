<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * UserFactory is used to generate test data for the User model.
 * This factory creates a user with a random name, email, and password for testing purposes.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     * We use a static property to store the password so it is consistent across multiple generations.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     * This method defines the attributes that should be generated for each new User instance.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Random name for the user
            'name' => fake()->name(),

            // Unique email for the user
            'email' => fake()->unique()->safeEmail(),

            // Email verification timestamp (we assume all users in tests have verified their email)
            'email_verified_at' => now(),

            // Password is hashed for security (we use a static password for consistency in tests)
            'password' => static::$password ??= Hash::make('password'),

            // Random 10-character remember token (used for "remember me" functionality)
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     * This is useful if you want to test users who have not verified their email.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
