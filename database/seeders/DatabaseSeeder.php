<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Lecturer;
use App\Models\Contact;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Course::factory(30)->create();
        Subject::factory(30)->create();
        Lecturer::factory(6)->create();
        Contact::factory(10)->create();
    }
}
