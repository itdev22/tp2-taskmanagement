<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'name' => 'Task 1',
            'description' => 'Description for Task 1',
            'user_id'=>2
        ]);
        Task::create([
            'name' => 'Task 2',
            'description' => 'Description for Task 2',
            'user_id'=>2
        ]);
        Task::create([
            'name' => 'Task 3',
            'description' => 'Description for Task 3',
            'user_id'=>2
        ]);
    }
}
