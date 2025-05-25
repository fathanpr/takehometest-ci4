<?php

namespace App\Controllers;

use Exception;
use Config\Database;
use App\Services\UserService;
use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $DB;
    public function __construct()
    {
        $this->userService = service('UserService');
        $this->DB = Database::connect();
    }

    public function index()
    {
         $dataPage = [
            'pageTitle' => "Users | Rekrutmen CBI",
            'contentTitle' => "Users",
            'page' => 'user-index',
        ];

        return view('users/index', $dataPage);
    }

    public function datatable()
    {
        $columns = [
            0 => 'users.username',
            1 => 'users.email',
            2 => 'users.name',
            3 => 'departments.name',
            4 => 'users.created_at',
        ];

        $totalData = $this->userService->countAllUser();
        $totalFiltered = $totalData;

        $limit = intval($this->request->getVar('length'));
        $start = intval($this->request->getVar('start'));
        $draw = $this->request->getVar('draw');
        $orderColumnIndex = $this->request->getVar('order')[0]['column'];
        $order = $columns[$orderColumnIndex];
        $dir = $this->request->getVar('order')[0]['dir'];

        $settings = [
            'start'   => $start,
            'limit'   => $limit,
            'order'   => $order,
            'dir'     => $dir,
            'columns' => $columns
        ];

        $dataFilter = [];
        $search = $this->request->getVar('search')['value'];
        if (!empty($search)) {
            $dataFilter['search'] = $search;
        }

        $users = $this->userService->getUserDatatable($dataFilter, $settings);
        $totalFiltered = $this->userService->countUserDatatable($dataFilter);

        $dataTable = [];
        if (!empty($users)) {
            foreach ($users as $data) {
                $nestedData['username']     = $data->username;
                $nestedData['email']        = $data->email;
                $nestedData['name']         = $data->name;
                $nestedData['department']   = $data->department_name;
                $nestedData['created_at']   = date('d M Y H:i', strtotime($data->created_at));
                $nestedData['action']       = '
                    <a href="javascript:void(0);" class="action-icon btnEdit" data-id="'.$data->id_user.'"> <i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="javascript:void(0);" class="action-icon btnDelete" data-id="'.$data->id_user.'"> <i class="mdi mdi-delete"></i></a>
                ';

                $dataTable[] = $nestedData;
            }
        }

        $json_data = [
            "draw"            => intval($draw),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $dataTable,
        ];

        return $this->response->setJSON($json_data);
    }

    public function store()
    {
        $rules = [
            'username' => [
                'rules'  => 'required|alpha_numeric|min_length[5]|is_unique[users.username]',
            ],
            'email'    => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
            ],
            'name'     => [
                'rules'  => 'required|alpha_space',
            ],
            'department_id' => [
                'rules' => 'required|numeric|is_not_unique[departments.id_department]',
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
            ],
            'password_confirmation' => [
                'rules'  => 'required_with[password]|matches[password]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'message' => array_values($errors)
            ])->setStatusCode(402);
        }

        $this->DB->transBegin();
        try {
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'name' => $this->request->getVar('name'),
                'department_id' => $this->request->getVar('department_id'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            ];

            $result = $this->userService->createUser($data);

            $this->DB->transCommit();
            return $this->response->setJSON([
                'message' => 'User created successfully',
                'status' => 'success',
                'data' => $result,
            ])->setStatusCode(200);
        } catch (Exception $e) {
            $this->DB->transRollback();
            return $this->response->setJSON([
                'message' => 'Failed to create user: ' . $e->getMessage(),
                'status' => 'error',
            ])->setStatusCode(500);
        }
    }

    public function update(int $id)
    {
        $rules = [
            'usernameEdit' => [
                'rules'  => 'required|alpha_numeric|min_length[5]|is_unique[users.username,id_user,'.$id.']',
            ],
            'emailEdit'    => [
                'rules'  => 'required|valid_email|is_unique[users.email,id_user,'.$id.']',
            ],
            'nameEdit'     => [
                'rules'  => 'required|alpha_space',
            ],
            'department_idEdit' => [
                'rules' => 'required|numeric|is_not_unique[departments.id_department]',
            ],
            'passwordEdit' => [
                'rules'  => 'permit_empty|min_length[8]',
            ],
            'password_confirmationEdit' => [
                'rules'  => 'permit_empty|matches[passwordEdit]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'message' => array_values($errors)
            ])->setStatusCode(402);
        }

        $this->DB->transBegin();
        try {
            $data = [
                'id_user' => $id,
                'username' => $this->request->getPost('usernameEdit'),
                'email' => $this->request->getPost('emailEdit'),
                'name' => $this->request->getPost('nameEdit'),
                'department_id' => $this->request->getPost('department_idEdit'),
            ];

            if ($password = $this->request->getPost('passwordEdit')) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }
          
            $result = $this->userService->updateUser($id, $data);
            
            $this->DB->transCommit();
            return $this->response->setJSON([
                'message' => 'User updated successfully',
                'status' => 'success',
                'data' => $result,
            ])->setStatusCode(200);
        } catch (Exception $e) {
            $this->DB->transRollback();
            return $this->response->setJSON([
                'message' => 'Failed to update user: ' . $e->getMessage(),
                'status' => 'error',
            ])->setStatusCode(500);
        }
    }

    public function delete(int $id)
    {
        $user = $this->userService->getUserById($id);
        $this->DB->transBegin();
        try {
            if (!$user) {
                $this->DB->transRollback();
                return $this->response->setJSON([
                    'message' => 'User not found',
                    'status' => 'error',
                ])->setStatusCode(404);
            }

            $this->userService->deleteUser($id);

            $this->DB->transCommit();
            return $this->response->setJSON([
                'message' => 'User deleted successfully',
                'status' => 'success',
            ])->setStatusCode(200);
        } catch (Exception $e) {
            $this->DB->transRollback();
            return $this->response->setJSON([
                'message' => 'Failed to delete user: ' . $e->getMessage(),
                'status' => 'error',
            ])->setStatusCode(500);
        }
    }
}
