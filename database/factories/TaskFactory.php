<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
public function definition(): array {
    return [
        'title' => $this->faker->sentence(4),
        'description' => $this->faker->text(),
        'status' => $this->faker->randomElement(['new', 'in_progress', 'done']),
        'project_id' => \App\Models\Project::factory(),
        'author_id' => \App\Models\User::factory(),
        'assigned_to' => \App\Models\User::factory(),
        'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
    ];
}
}


