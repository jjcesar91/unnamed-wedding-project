<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;


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

     protected $types = ['matrimonio','promessa','battesimo','cresima','argento','oro','platino','compleanno','rinnovo','baby'];

    public function definition(): array
    {
        return [
            'title'=> $this->faker->word(),
            'description'=> $this->faker->text(250),
            'location'=> 'castel sant\'antangelo',
            'type'=> $this->faker->randomElement($this->types),
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
        return $this->afterCreating(function (Event $event) {

            $directoryName = $event->id . "_" . $event->title;

            $directoryPath = "events/$directoryName"; 
            if (!Storage::exists($directoryPath)) {
                Storage::makeDirectory($directoryPath);
            }

            Directory::factory()->create([
                'event_id' => $event->id,
                'name' => $directoryName, 
            ]);
        });
    }

}
