<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'comic', 'fantasy', 'romance', 'fiction', 'mistery', 'horror', 'western'
        ];
        foreach ($data as $value) {
            Category::insert([
                'name' => $value
            ]);
        }
    }
}
