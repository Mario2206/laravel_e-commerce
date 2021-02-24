<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param Filesystem $fs
     * @param CategorySeeder $categorySeeder
     * @param ProductSeeder $productSeeder
     * @return void
     */
    public function run(Filesystem $fs, CategorySeeder $categorySeeder, ProductSeeder $productSeeder)
    {
        //clean DB
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        //clean storage
        $fs->cleanDirectory('storage/app/images');

        //seeds
         User::factory(2)->admin()->create();
         $categorySeeder->run(10);
         $productSeeder->run(100);
    }
}
