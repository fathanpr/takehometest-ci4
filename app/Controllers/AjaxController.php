<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AjaxController extends BaseController
{
    public function __construct()
    {
        $this->departmentService = service('DepartmentService');
        $this->userService = service('UserService');
    }

    public function select_get_departments()
    {
        $dataFilter = [];

        $search = $this->request->getVar('search');
        if (!empty($search)) {
            $dataFilter['search'] = $search;
        }

        $departments = $this->departmentService->getDepartmentWithFilter($dataFilter, ['id_department', 'name']);
        $perPage = 10;
        $page = $this->request->getVar('page');

        $paginated = $departments->paginate($perPage);
        $morePages = $departments->pager->getNextPageURI();

        $departmentDatas = [];
        if (!empty($paginated)) {
            foreach ($paginated as $department) {
                $departmentDatas[] = [
                    'id' => $department->id_department,
                    'text' => $department->name
                ];
            }
        }

        $results = [
            "results" => $departmentDatas,
            "pagination" => [
                "more" => $morePages
            ]
        ];

        return $this->response->setJSON($results);
    }

    public function get_user_by_id(int $id)
    {
        $fields = [
            'users.id_user',
            'users.username',
            'users.name',
            'users.email',
            'users.department_id',
            'departments.name as department_name'
        ];
        
        $user = $this->userService->getUserByIdWithDepartment($id, $fields);
        if (!$user) {
            return $this->response->setJSON([
                'message' => 'User not found'
            ])->setStatusCode(404);
        }
        return $this->response->setJSON([
            'message' => 'User retrived successfully',
            'data' => $user,
            'status' => 'success',
        ])->setStatusCode(200);
    }
}
