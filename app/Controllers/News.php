<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\SubMenuModel;

class News extends BaseController
{
    protected $submenuModel;
    protected $newsModel;

    public function __construct()
    {
        $this->submenuModel = new SubMenuModel();
        $this->newsModel = new NewsModel();
    }

    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $data = [
            'title' => 'News & Articles',
            'active' => $this->submenuModel->find(5)->submenu
        ];

        return view('news/index', $data);
    }

    public function getDataNews()
    {
        if ($this->request->isAJAX()) {

            if (!check_login()) return redirect()->to(base_url('login'));

            $news = $this->newsModel->find();

            $data = [
                'news' => $news
            ];

            $msg = [
                'data' => view('news/tableData', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('news'));
        }
    }
}
