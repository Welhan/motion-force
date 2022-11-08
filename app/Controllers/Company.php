<?php

namespace App\Controllers;

use App\Models\SubMenuModel;
use App\Models\UserModel;
use Exception;

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
        if ($this->request->isAJAX()) {

            // Verify if user already Login
            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            // Start Validation
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'company_name' => [
                    'label' => 'Company Name',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} required',
                        // 'is_unique' => '{field} already exist'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'company_name' => $validation->getError('company_name')
                    ]
                ];

                echo json_encode($msg);
                return;
            }

            $data = [
                'id' => 1,
                'nama' => htmlspecialchars($this->request->getPost('nama')),
                'phone' => htmlspecialchars($this->request->getPost('phone')),
                'email' => htmlspecialchars($this->request->getPost('company_email')),
                'wechat' => htmlspecialchars($this->request->getPost('wechat')),
                'whatsapp' => htmlspecialchars($this->request->getPost('whatsapp')),
                'img' => htmlspecialchars($this->request->getPost('nama')),
            ];

            try {
                if ($this->userModel->save($data)) {
                    $alert = [
                        'message' => "Company Profile Has Been Updated",
                        'alert' => 'alert-success'
                    ];

                    $msg = ['success' => 'Process Success'];
                }
            } catch (Exception $e) {
                $alert = [
                    'message' => "Company Profile Not Updated<br> " . $e->getMessage(),
                    'alert' => 'alert-danger'
                ];

                $msg = ['error' => 'Process Terminated'];
            } finally {
                session()->setFlashdata($alert);
                echo json_encode($msg);
            }
        } else {
            return redirect()->to(base_url('company'));
        }
    }
}
