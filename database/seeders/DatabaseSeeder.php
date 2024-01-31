<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // create 10 categories from factory
    $categories = Category::factory(10)->create();

    // "do this for each category"
    $categories->each(function (Category $category) {
        // optional
        $this->command->getOutput()->info(
            message: "Creating posts for category: [$category->name]",
        );

        // optional
        $bar = $this->command->getOutput()->createProgressBar(100);

        // loop 100x
        for ($i = 0; $i < 100; $i++) {
            // optional
            $bar->advance();

            // create a post from factory
            Post::factory()->create([
                // use category id from current category
                'category_id' => $category->id,
            ]);
        }

        // optional
        $bar->finish();
    });
    }
}
