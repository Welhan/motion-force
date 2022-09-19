<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\SubMenuModel;

class Category extends BaseController
{
    protected $submenuModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->submenuModel = new SubMenuModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $data = [
            'title' => 'Category',
            'active' => $this->submenuModel->find(2)->submenu
        ];
        return view('category/index', $data);
    }

    public function getDataCategory()
    {
        if ($this->request->isAJAX()) {

            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $category = $this->categoryModel->orderBy('id', 'desc')->findAll();
            $data = [
                'categorys' => $category
            ];

            $msg = [
                'data' => view('category/tableData', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('category'));
        }
    }
}
