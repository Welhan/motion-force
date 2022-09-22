<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['categoryID', 'name', 'description', 'image', 'active', 'user_added', 'date_added', 'user_updated', 'date_updated'];

    public function getAllData()
    {
        $query = "SELECT product.*, product.id as productID, category.id as categoryID, category.category FROM product LEFT JOIN category ON product.categoryID = category.id ORDER BY product.id desc";

        return $this->query($query)->getResultObject();
    }

    public function getProduct($id)
    {
        $query = "SELECT product.*, product.id as productID, category.id as categoryID, category.category FROM product LEFT JOIN category ON product.categoryID = category.id WHERE product.id = $id ORDER BY product.id desc";

        return $this->query($query)->getResultObject();
    }
}
