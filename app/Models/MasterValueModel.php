<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterValueModel extends Model
{
    protected $table = 'mst_value';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [];
}
