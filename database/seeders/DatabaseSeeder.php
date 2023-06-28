<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        // DB::table('users')->insert([
        //     'email' => 'admin@gmail.com',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        //     'role' => 1,
        //     'point' => 0
        // ]);
        // DB::table('users_information')->insert([
            
        //     'user_id' => 1
        // ]);
        // DB::table('categories')->insert([
        //     'name' => 'Toán'
        // ]);
        // DB::table('sub_categories')->insert([
        //     'name' => 'Toán 7',
        //     'category_id' => 1
        // ]);
        // DB::table('promotions')->insert([
        //     'name' => 'Vào hè',
        //     'description' => 'Vào hè',
        //     'sale' => 20,
        //     'date_expired' => '2022-1-1',
        // ]);
        // DB::table('products')->insert([
        //     'product_code' => 'SGK020313',
        //     'quantity' => 20,
        //     'price' => 12000,
        //     'price_sale' => 10000,
        //     'promotion_id' => null,
        // ]);
        // DB::table('orders')->insert([
        //     'price' => 12000,
        //     // 'date' => '2021-9-21',
        //     'state' => 0,
        //     'user_id' => 1,
        // ]);
        DB::table('order_product')->insert([
            'order_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
        ]);
        DB::table('product_information')->insert([
            'name' => 'Sách giáo khoa Toán 7',
            'author' => 'Bộ giáo dục',
            'published' => 'NXB Giáo dục',
            'decs' => 'Sản phẩm tốt',
            'language' => 'Tiếng Việt',
            'year' => 2008,
            'product_id' => 1,
        ]);
        DB::table('image_products')->insert([
            'path' => 'kh1.jpg',
            'product_id' => 1,
        ]);
        DB::table('product_sub_cate')->insert([
            'sub_category_id' => 1,
            'product_id' => 1,
        ]);
        DB::table('ratings')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'rate' => 4,
            'content' => 'Sản phẩm tốt',
        ]);
    }
}
