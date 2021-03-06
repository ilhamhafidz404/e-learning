<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            LessonSeeder::class,
            TeacherSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            QuestionSeeder::class
            // ModelHasRoleSeeder::class,
        ]);

        // Question::factory(20)->create();
    }
}
