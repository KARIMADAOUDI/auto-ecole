<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InstructorSeeder::class,
            VehicleSeeder::class,
            StudentSeeder::class,
            LessonSeeder::class,
            PaymentSeeder::class,
            InvoiceSeeder::class,
            VehicleExpenseSeeder::class,
            PersonalExpenseSeeder::class,
        ]);
    }
}
