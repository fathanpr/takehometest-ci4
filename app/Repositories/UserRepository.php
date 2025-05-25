<?php

namespace App\Repositories;

use CodeIgniter\Model;
use App\Models\UserModel;

class UserRepository
{
    protected $userModel;
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUserById($id)
    {
        return $this->userModel->find($id);
    }

    public function getUserByIdWithDepartment(int $id, array $select = ['*'])
    {
        $query = $this->userModel->select($select)
            ->join('departments', 'departments.id_department = users.department_id', 'LEFT')
            ->where('id_user', $id);

        return $query->first();
    }

    public function getAllUser(array $select = ['*'])
    {
        return $this->userModel->select($select)->findAll();
    }

    public function getUserWithFilter(array $dataFilter, array $select = ['*'])
    {
        $query = $this->userModel->select($select);

        if (isset($dataFilter['search'])) {
            $query->like('username', $dataFilter['search'])
                ->orLike('name', $dataFilter['search'])
                ->orLike('email', $dataFilter['search']);
        }

        return $query;
    }

    private function _query(array $dataFilter)
    {
        $query = $this->userModel->select(['users.*', 'departments.name as department_name'])
            ->join('departments', 'departments.id_department = users.department_id', 'LEFT');

        if (isset($dataFilter['search'])) {
            $query->groupStart()
                ->like('users.username', $dataFilter['search'])
                    ->orLike('users.name', $dataFilter['search'])
                    ->orLike('users.email', $dataFilter['search'])
                    ->orLike('departments.name', $dataFilter['search'])
                ->groupEnd();
        }

        return $query;
    }

    public function getUserDatatable(array $dataFilter, array $settings)
    {
        return $this->_query($dataFilter)
            ->limit($settings['limit'], $settings['start'])
            ->orderBy($settings['order'], $settings['dir'])
            ->get()->getResult();
    }

    public function countUserDatatable(array $dataFilter)
    {
        return $this->_query($dataFilter)->countAllResults();
    }

    public function countAllUser()
    {
        return $this->userModel->countAllResults();
    }

    public function createUser(array $data)
    {
        $user = $this->userModel->insert($data);
        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->userModel->update($id, $data);
        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $this->userModel->delete($id);
            return true;
        }
        return false;
    }
}
