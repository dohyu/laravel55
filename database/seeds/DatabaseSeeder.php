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

        \App\Article::truncate();
        $categoryIds = \App\Category::
            whereKeyName('articles')->firstOrFail()
            ->children()->pluck('id');
        for ($i = 0; $i < 100; $i++) {
            $date = $faker->dateTimeThisMonth;

            \App\Article::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
                'user_id' => 1,
                'category_id' => $faker->randomElement($categoryIds),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
        

        // App\Category::truncate();
        // factory(App\Category::class, 10)->create();

        // $categories = App\Category::all();
        // $categories->each(function ($category) use ($faker) {
        //     $parentIds = App\Category::pluck('id')->toArray();
        //     App\Category::create([
        //         'name' => $faker->word(),
        //         'value' => $faker->sentence(),
        //         'parent_id' => $faker->randomElement($parentIds),
        //     ]);
        // });

        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
