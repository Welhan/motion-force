<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = 'mst_submenu';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    // protected $allowedFields = ['category', 'active', 'user_added', 'date_added', 'user_update', 'date_update'];
}
