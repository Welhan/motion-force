<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['category', 'active', 'user_added', 'date_added', 'user_update', 'date_update'];
}
