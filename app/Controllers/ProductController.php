<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();
        $data['title'] = 'Ürünler';

        return view('product/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Yeni Ürün Ekle';
        return view('product/create', $data);
    }

    public function store()
    {
        $productModel = new ProductModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
        ];

        $productModel->insert($data);
        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->delete($id);

        return redirect()->to('/products');
    }
}
