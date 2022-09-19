<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\SubMenuModel;
use Exception;

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

    public function getFormNew()
    {
        if ($this->request->isAJAX()) {
            // Verify if user already Login
            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $msg = [
                'data' => view('category/modals/NewModal')
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('category'));
        }
    }

    public function newCategory()
    {

        if ($this->request->isAJAX()) {

            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $name = ucwords(htmlspecialchars($this->request->getPost('category'), true));
            $active = $this->request->getPost('active');

            // Start Validation
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'category' => [
                    'label' => 'Category',
                    'rules' => 'required|is_unique[category.category]',
                    'errors' => [
                        'required' => '{field} required',
                        'is_unique' => '{field} already exist'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'category' => $validation->getError('category')
                    ]
                ];
            }

            if (!empty($msg['error'])) {
                echo json_encode($msg);
                return;
            }

            $data = [
                'category' => $name,
                'active' => ($active) ? $active : 0,
                'user_added' => session('username'),
                'date_added' => date('Y/m/d H:i:s')
            ];

            try {
                if ($this->categoryModel->save($data)) {
                    $alert = [
                        'message' => "Category: $name Saved",
                        'alert' => 'alert-success'
                    ];

                    $msg = ['success' => 'Process Success'];
                }
            } catch (Exception $e) {
                $alert = [
                    'message' => "Category: $name Not Saved<br> " . $e->getMessage(),
                    'alert' => 'alert-danger'
                ];

                $msg = ['error' => 'Process Terminated'];
            } finally {
                session()->setFlashdata($alert);
                echo json_encode($msg);
            }
        } else {
            return redirect()->to(base_url('category'));
        }
    }
}
