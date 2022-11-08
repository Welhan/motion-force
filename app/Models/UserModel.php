<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'phone', 'email', 'wechat', 'whatsapp', 'img', 'username', 'password', 'reset_pass', 'active', 'date_added'];
}
