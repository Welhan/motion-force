<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login/index');
    }

    public function login()
    {
        if (check_login()) return redirect()->to(base_url('/admin'));

        $username = htmlspecialchars($this->request->getPost('username'), true);
        $password = htmlspecialchars($this->request->getPost('password'), true);

        // d(sha1($password));
        // dd($this->userModel->where(['username' => $username])->find()[0]->password);

        $result = $this->userModel->where(['username' => $username])->find();

        if (count($result) == 0 || $result[0]->password != sha1($password)) {
            $alert = [
                'message' => 'Username atau Password Salah',
                'alert' => 'alert-danger'
            ];

            session()->setFlashdata($alert);
            return redirect()->to(base_url('login'));
        } else {
            $session = [
                'username' => $result[0]->username
            ];

            session()->set($session);
            return redirect()->to(base_url('/admin'));
        }
    }

    public function logout()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        session()->destroy();
        $alert = [
            'message' => 'Logged Out',
            'alert' => 'alert-success'
        ];
        session()->setFlashdata($alert);
        return redirect()->to(base_url('login'));
    }
}
