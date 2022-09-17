<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $data = [
            'title' => 'Dashboard'
        ];
        return view('dashboard/index', $data);
    }
}
