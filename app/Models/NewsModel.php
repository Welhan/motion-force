<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['title', 'image', 'description', 'tag', 'date_added', 'active'];
}
