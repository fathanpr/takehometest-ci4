<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUserByIdWithDepartment(int $id, array $select = ['*'])
    {
        return $this->userRepository->getUserByIdWithDepartment($id, $select);
    }

    public function getAllUser(array $select = ['*'])
    {
        return $this->userRepository->getAllUser($select);
    }

    public function getUserWithFilter(array $dataFilter, array $select = ['*'])
    {
        return $this->userRepository->getUserWithFilter($dataFilter, $select);
    }

    public function getUserDatatable(array $dataFilter, array $settings)
    {
        return $this->userRepository->getUserDatatable($dataFilter, $settings);
    }

    public function countUserDatatable(array $dataFilter)
    {
        return $this->userRepository->countUserDatatable($dataFilter);
    }

    public function countAllUser()
    {
        return $this->userRepository->countAllUser();
    }

    public function createUser(array $data)
    {
        return $this->userRepository->createUser($data);
    }

    public function updateUser(int $id, array $data)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser(int $id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
