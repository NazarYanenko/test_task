<?php

/**
 * Created by PhpStorm.
 * User: nazar
 * Date: 12.09.18
 * Time: 19:17
 */
use Illuminate\Database\Seeder;
use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create();
    }
}