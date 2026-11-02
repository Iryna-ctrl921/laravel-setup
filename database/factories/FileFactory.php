<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
public function definition(): array
    {
        return [
            'file_path' => 'files/' . $this->faker->uuid . '.jpg',
            'original_name' => $this->faker->word . '.jpg',
            'fileable_id' => \App\Models\Project::factory(),
            'fileable_type' => \App\Models\Project::class,
        ];
    }
}

