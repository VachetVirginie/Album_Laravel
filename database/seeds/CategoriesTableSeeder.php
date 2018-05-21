<?php
    use Illuminate\Database\Seeder;
    use App\Models\Category;
    class CategoriesTableSeeder extends Seeder
    {
        public function run()
        {
            Category::create([
                'name' => 'Graffitis',
            ]);
            Category::create([
                'name' => 'Tags',
            ]);
            Category::create([
                'name' => 'Fresques',
            ]);
            Category::create([
                'name' => 'Stickers',
            ]);
            Category::create([
                'name' => 'Stencils',
            ]);
        }
    }