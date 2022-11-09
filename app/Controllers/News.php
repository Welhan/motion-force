<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\SubMenuModel;
use Exception;

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

            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $news = $this->newsModel->find();

            $data = [
                'news' => $news
            ];

            $msg = [
                'data' => view('news/tableData1', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('news'));
        }
    }

    public function getFormNew()
    {
        if ($this->request->isAJAX()) {
            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $msg = [
                'data' => view('news/modals/newModal')
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('news'));
        }
    }

    public function saveNews()
    {
        if ($this->request->isAJAX()) {
            if (!check_login()) {
                $msg = [
                    'error' => ['logout' => base_url('logout')]
                ];
                echo json_encode($msg);
                return;
            }

            $title = htmlspecialchars($this->request->getPost('title'), true);
            $description = htmlspecialchars($this->request->getPost('description'), true);
            $tag = htmlspecialchars($this->request->getPost('tag'), true);
            $active = $this->request->getPost('active');

            // Start Validation
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'title' => [
                    'label' => 'Title',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} required',
                        'is_unique' => '{field} already exist'
                    ]
                ],
                'description' => [
                    'label' => 'Description',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} required',
                        'is_unique' => '{field} already exist'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'title' => $validation->getError('title'),
                        'description' => $validation->getError('description'),
                    ]
                ];
            }

            if (!empty($msg['error'])) {
                echo json_encode($msg);
                return;
            }

            $data = [
                'title' => $title,
                'description' => $description,
                'tag' => $tag,
                'date_added' => date('Y-m-d'),
                'active' => ($active) ? 1 : 0
            ];

            try {
                if ($this->newsModel->save($data)) {
                    $alert = [
                        'message' => "News: $title Created",
                        'alert' => 'alert-success'
                    ];

                    $msg = ['success' => 'Process Success'];
                }
            } catch (Exception $e) {
                $alert = [
                    'message' => "News: $title Not Created<br> " . $e->getMessage(),
                    'alert' => 'alert-danger'
                ];

                $msg = ['error' => 'Process Terminated'];
            } finally {
                session()->setFlashdata($alert);
                echo json_encode($msg);
            }
        } else {
            return redirect()->to(base_url('news'));
        }
    }
}
