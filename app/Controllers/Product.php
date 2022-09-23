<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\SubMenuModel;
use Exception;

class Product extends BaseController
{
    protected $submenuModel;
    protected $categoryModel;
    protected $productModel;

    public function __construct()
    {
        $this->submenuModel = new SubMenuModel();
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        // dd($this->productModel->getProduct(1));

        $data = [
            'title' => 'Product',
            'active' => $this->submenuModel->find(3)->submenu
        ];

        return view('product/index', $data);
    }
    public function getDataProduct()
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

            $products = $this->productModel->getAllData();

            $data = [
                'products' => $products
            ];

            $msg = [
                'data' => view('product/tableData', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('product'));
        }
    }

    public function newProduct()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $categorys = $this->categoryModel->where('active', 1)->findAll();

        $data = [
            'title' => 'Product',
            'categorys' => $categorys,
            'validation' => \Config\Services::validation(),
            'active' => $this->submenuModel->find(3)->submenu
        ];

        return view('product/newProduct', $data);
    }

    public function saveProduct()
    {
        if (!check_login()) return redirect()->to(base_url('login'));

        $name = ucwords(htmlspecialchars($this->request->getPost('product')));
        $categoryID = $this->request->getPost('category_id');
        $description = htmlspecialchars($this->request->getPost('description'));
        $active = ($this->request->getPost('active')) ? $this->request->getPost('active') : 0;

        if (!$this->validate([
            'product' => [
                'label' => 'Product Name',
                'rules' => 'required|is_unique[product.name]',
                'errors' => [
                    'required' => '{field} required',
                    'is_unique' => '{field} already exist'
                ]
            ],
            'category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ]
            ],
            'pic' => [
                'label' => 'Product Picture',
                'rules' => 'uploaded[pic]|mime_in[pic,image/png,image/jpg,image/jpeg]|is_image[pic]',
                'errors' => [
                    'uploaded' => '{field} required',
                    'mime_in' => '{field} must be image',
                    'is_image' => '{field} must be image',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/newProduct'))->withInput();
        }

        // Save Picture to Folder
        $pic = $this->request->getFile('pic');

        $image = ucwords($name) . '.' . $pic->getExtension();
        // dd($image);

        $pic->move('img/product', $image);

        $data = [
            'categoryID' => $categoryID,
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'active' => $active,
            'user_added' => session('username'),
            'date_added' => date('Y-m-d')
        ];

        try {
            if ($this->productModel->save($data)) {
                $alert = [
                    'message' => "Product $name Saved",
                    'alert' => 'alert-success'
                ];
            }
        } catch (Exception $e) {
            $alert = [
                'message' => "Product $name Not Saved<br> " . $e->getMessage(),
                'alert' => 'alert-danger'
            ];
        } finally {
            session()->setFlashdata($alert);
            return redirect()->to(base_url('product'));
        }
    }

    public function getformEdit()
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

            $id = $this->request->getPost('id');

            $product = $this->productModel->getProduct($id)[0];
            $categorys = $this->categoryModel->where('active', 1)->findAll();

            $data = [
                'product' => $product,
                'categorys' => $categorys
            ];

            $msg = [
                'data' => view('product/editProduct', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to(base_url('product'));
        }
    }

    public function updateProduct()
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

            $id = $this->request->getPost('id');
            $name = htmlspecialchars($this->request->getPost('product'), true);
            $categoryID = $this->request->getPost('category_id');
            $description = htmlspecialchars($this->request->getPost('description'));
            $active = ($this->request->getPost('active')) ? $this->request->getPost('active') : 0;

            $oldProduct = $this->productModel->find($id);

            if ($oldProduct->name == $name) {
                $rules = 'required';
            } else {
                $rules = 'required|is_unique[product.name]';
            }

            // Start Validation
            $validation = \Config\Services::validation();

            $pic = $this->request->getFile('pic');

            if ($pic->getError() == 4) {
                $valid = $this->validate([
                    'product' => [
                        'label' => 'Product Name',
                        'rules' => $rules,
                        'errors' => [
                            'required' => '{field} required',
                            'is_unique' => '{field} already exist'
                        ]
                    ],
                    'category' => [
                        'label' => 'Category',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} required'
                        ]
                    ]
                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'product' => $validation->getError('product'),
                            'category' => $validation->getError('category')
                        ]
                    ];
                }
            } else {
                $valid = $this->validate([
                    'product' => [
                        'label' => 'Product Name',
                        'rules' => $rules,
                        'errors' => [
                            'required' => '{field} required',
                            'is_unique' => '{field} already exist'
                        ]
                    ],
                    'category' => [
                        'label' => 'Category',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} required'
                        ]
                    ],
                    'pic' => [
                        'label' => 'Product Picture',
                        'rules' => 'is_image[pic]|mime_in[pic,image/png,image/jpg,image/jpeg]',
                        'errors' => [
                            'mime_in' => '{field} must be image',
                            'is_image' => '{field} must be image'
                        ]
                    ],
                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'product' => $validation->getError('product'),
                            'category' => $validation->getError('category'),
                            'pic' => $validation->getError('pic'),
                        ]
                    ];
                }
            }

            if (!empty($msg['error'])) {
                echo json_encode($msg);
                return;
            }

            if ($pic->getError() == 4) {
                $image = $oldProduct->image;
            } else {

                $image = ucwords($name) . '.' . $pic->getExtension();
                // dd($image);

                $pic->move('img/product', $image);

                unlink('img/' . $this->request->getPost('oldImg'));
            }

            $data = [
                'id' => $id,
                'categoryID' => $categoryID,
                'name' => $name,
                'description' => $description,
                'image' => $image,
                'active' => $active,
                'user_update' => session('username'),
                'date_update' => date('Y-m-d h:i:s')
            ];

            try {
                if ($this->productModel->save($data)) {
                    $alert = [
                        'message' => "Product $name Updated",
                        'alert' => 'alert-success'
                    ];

                    $msg = ['success' => 'Process Success'];
                }
            } catch (Exception $e) {
                $alert = [
                    'message' => "Product $name Not Updated<br> " . $e->getMessage(),
                    'alert' => 'alert-danger'
                ];

                $msg = ['error' => 'Process Terminated'];
            } finally {
                session()->setFlashdata($alert);
                echo json_encode($msg);
            }
        } else {
            return redirect()->to(base_url('product'));
        }
    }
}
