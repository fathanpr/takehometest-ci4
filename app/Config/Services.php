<?php

namespace Config;

use App\Models\UserModel;
use App\Services\UserService;
use App\Models\DepartmentModel;
use App\Services\DepartmentService;
use CodeIgniter\Config\BaseService;
use App\Repositories\UserRepository;
use App\Repositories\DepartmentRepository;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    /**
     * Mengembalikan instance dari UserRepository.
     * Service ini bergantung pada UserModel.
     *
     * @param boolean $getShared
     * @return UserRepository
     */
    public static function userRepository(bool $getShared = true): UserRepository
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }
        $userModel = new UserModel();
        return new UserRepository($userModel);
    }

    public static function departmentRepository(bool $getShared = true): DepartmentRepository
    {
        if ($getShared) {
            return static::getSharedInstance('departmentRepository');
        }
        $departmentModel = new DepartmentModel();
        return new DepartmentRepository($departmentModel);
    }

    /**
     * Mengembalikan instance dari UserService.
     * Service ini bergantung pada UserRepository.
     *
     * @param boolean $getShared
     * @return UserService
     */
    public static function userService(bool $getShared = true): UserService
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService(static::userRepository());
    }

    public static function departmentService(bool $getShared = true): DepartmentService
    {
        if ($getShared) {
            return static::getSharedInstance('departmentService');
        }

        return new DepartmentService(static::departmentRepository());
    }
}
