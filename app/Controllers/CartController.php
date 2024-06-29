<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use CodeIgniter\Controller;

class CartController extends Controller
{
    protected $cartModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function add($productId)
    {
        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Ürün bulunamadı');
        }

        $data = [
            'product_id' => $productId,
            'quantity' => 1,
            'user_id' => 1, 
        ];

        $this->cartModel->insert($data);

        return redirect()->back()->with('success', 'Ürün sepete eklendi');
    }

    public function view()
    {
        $cartItems = $this->cartModel->findAll();
        $data = [
            'cartItems' => $cartItems,
            'productModel' => $this->productModel
        ];
        return view('cart/view', $data);
    }

    public function remove($id)
    {
        $this->cartModel->delete($id);
        return redirect()->back()->with('success', 'Ürün sepetten silindi');
    }
}
