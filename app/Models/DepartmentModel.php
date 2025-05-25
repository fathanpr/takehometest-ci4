<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table            = 'departments';
    protected $primaryKey       = 'id_department';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'id_department' => 'permit_empty|numeric',
        'name' => 'required|alpha_space|min_length[3]|max_length[255]|is_unique[departments.name,id_department,{id_department}]',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
