<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'priority' => $this->faker->randomNumber(1, 5),
            'project_id' => fake()->unique()->numberBetween(1, Project::count()),
        ];
    }
}
