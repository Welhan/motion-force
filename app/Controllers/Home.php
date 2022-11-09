<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    // Starter Template Controller
    // public function index()
    // {
    //     return view('welcome_message');
    // }

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $company = $this->userModel->find(1);
        $data = [
            'company' => $company
        ];
        return view('fe_home/index', $data);
    }
}
