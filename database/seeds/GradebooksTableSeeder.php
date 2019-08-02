<?php

use Illuminate\Database\Seeder;

class GradebooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Professor::class, 30)->create();
        factory(App\Gradebook::class, 30)->create();
    }
}
