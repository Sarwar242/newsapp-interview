<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUser();
    }

    private function createUser()
    {
        $user = new User();
        $user->first_name = "John";
        $user->last_name = "Doe";
        $user->email = "user@news-app.com";
        $user->avatar = "storage/user/avatar/no_avatar.png";
        $user->password = bcrypt("123456");
        $user->phone = '01600000000';
        $user->save();
    }
}
