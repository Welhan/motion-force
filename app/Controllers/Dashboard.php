<?php

namespace App\Controllers;

use App\Models\SubMenuModel;

class Dashboard extends BaseController
{
    protected $submenuModel;

    public function __construct()
    {
        $this->submenuModel = new SubMenuModel();
    }

    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $data = [
            'title' => 'Dashboard',
            'active' => $this->submenuModel->find(1)->submenu
        ];
        return view('dashboard/index', $data);
    }
}
