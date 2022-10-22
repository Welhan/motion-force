<?php

namespace App\Controllers;

use App\Models\SubMenuModel;
use App\Models\UserModel;

class Company extends BaseController
{
    protected $submenuModel;
    protected $userModel;

    public function __construct()
    {
        $this->submenuModel = new SubMenuModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $data = [
            'title' => 'Company Profile',
            'active' => $this->submenuModel->find(4)->submenu
        ];
        return view('company/index', $data);
    }

    public function getProfile()
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

            $data = [
                'company' => $this->userModel->find(1)
            ];

            $msg = [
                'data' => view('company/tableData', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('company'));
        }
    }

    public function getFormEdit()
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

            $data = [
                'company' => $this->userModel->find(1)
            ];

            $msg = [
                'data' => view('company/edit', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('company'));
        }
    }

    public function saveProfile()
    {
    }
}
