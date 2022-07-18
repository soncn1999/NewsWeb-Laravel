<?php

use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            ['name' => 'admin','code' => 'Quản trị Page'],
            ['name' => 'guest','code' => 'Người đọc'],
            ['name' => 'developer','code' => 'Nhà phát triển'],
            ['name' => 'content','code' => 'Biên tập nội dung'],
        ]);
    }
}
