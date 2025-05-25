<?php

namespace App\Database\Seeds;

use Faker\Factory;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'PRABOWO',
                'name' => 'Prabowo Sukasalto',
                'email' => 'prabowo@gmail.com',
                'department_id' => 1,
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'JOYKOWI',
                'name' => 'Joyko Wi',
                'email' => 'joykowi@gmail.com',
                'department_id' => 2,
                'password' => password_hash('fathanpr', PASSWORD_DEFAULT),
            ],
        ];

        // gunakan faker untuk generate data user lebih banyak 
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $users[] = [
            'username' => $faker->userName,
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'department_id' => rand(1, 8),
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            ];
        }

        $userModel = new UserModel();
        foreach ($users as $user) {
            $userModel->insert($user);
        }
    }
}
