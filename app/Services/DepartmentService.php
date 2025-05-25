<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getDepartmentById(int $id)
    {
        return $this->departmentRepository->getDepartmentById($id);
    }

    public function getDepartmentWithFilter(array $dataFilter, array $select = ['*'])
    {
        return $this->departmentRepository->getDepartmentWithFilter($dataFilter, $select);
    }

}
