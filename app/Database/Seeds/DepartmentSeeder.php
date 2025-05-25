<?php

namespace App\Database\Seeds;

use App\Models\DepartmentModel;
use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
            ['name' => 'Customer Support'],
            ['name' => 'IT Support'],
            ['name' => 'Research and Development'],
        ];

        $departmentModel = new DepartmentModel();
        foreach ($departments as $department) {
            $departmentModel->insert($department);
        }
    }
}
