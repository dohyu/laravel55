<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $faker = app(Faker\Generator::class);

        App\Category::truncate();
        factory(App\Category::class, 10)->create();

        $categories = App\Category::all();
        $categories->each(function ($category) use ($faker) {
            $parentIds = App\Category::pluck('id')->toArray();
            App\Category::create([
                'name' => $faker->word(),
                'value' => $faker->sentence(),
                'parent_id' => $faker->randomElement($parentIds),
            ]);
        });

        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
