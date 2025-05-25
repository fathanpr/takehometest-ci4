<?php

namespace App\Repositories;

use CodeIgniter\Model;
use App\Models\DepartmentModel;

class DepartmentRepository
{
    protected $departmentModel;
    public function __construct(DepartmentModel $departmentModel)
    {
        $this->departmentModel = $departmentModel;
    }

    public function getDepartmentById($id)
    {
        return $this->departmentModel->find($id);
    }

    public function getDepartmentWithFilter(array $dataFilter, array $select = ['*'])
    {
        $query = $this->departmentModel->select($select);

        if (isset($dataFilter['search'])) {
            $query->like('name', $dataFilter['search']);
        }

        return $query;
    }
}