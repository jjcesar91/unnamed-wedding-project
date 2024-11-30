<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Event;
use App\Models\Directory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->word(),
            'active' => $this->faker->boolean()
        ];
    }

    public function withUsers($count = 3)
    {
        return $this->afterCreating(function (Event $event) use ($count) {
            $users = User::inRandomOrder()->take($count)->pluck('id');
            $event->users()->attach($users);
        });
    }

    public function withDirectory()
    {
        return $this->has(Directory::factory(), 'directory');
    }
}
