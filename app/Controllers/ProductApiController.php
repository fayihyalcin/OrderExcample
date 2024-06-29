<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;
use App\Models\UserModel;

class ProductApiController extends ResourceController
{
    use ResponseTrait;

    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }

    private function verifyBasicAuth()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return false;
        }

        list($type, $credentials) = explode(' ', $authHeader, 2);
        if (strtolower($type) !== 'basic') {
            return false;
        }

        $decodedCredentials = base64_decode($credentials);
        list($username, $password) = explode(':', $decodedCredentials, 2);

        $user = $this->userModel->where('username', $username)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        return true;
    }

    public function index()
    {
        if (!$this->verifyBasicAuth()) {
            return $this->failUnauthorized('Yetkisiz erişim');
        }

        $products = $this->productModel->findAll();
        return $this->respond($products);
    }

    public function create()
    {
        if (!$this->verifyBasicAuth()) {
            return $this->failUnauthorized('Yetkisiz erişim');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price')
        ];

        if ($this->productModel->insert($data)) {
            return $this->respondCreated($data);
        }

        return $this->fail('Ürün eklenemedi');
    }
}
