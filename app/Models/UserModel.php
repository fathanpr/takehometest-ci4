<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DepartmentModel;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $returnType = 'object';
    protected $allowedFields = ['username', 'name', 'email', 'password', 'department_id'];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_user'  => 'permit_empty|numeric',
        'username' => 'alpha_numeric_space|min_length[3]|max_length[100]|is_unique[users.username, id_user,{id_user}]',
        'name'     => 'alpha_space|min_length[8]|max_length[255]',
        'email'    => 'valid_email|is_unique[users.email,id_user,{id_user}]',
        'password' => 'min_length[8]|max_length[255]',
        'department_id' => 'numeric|is_not_unique[departments.id_department]',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
