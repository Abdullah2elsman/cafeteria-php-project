<?php

class Home extends Controller{
    private $productModel;

    public function __construct(){
        $this->productModel = $this->model('Product');
    }

    public function index(){
        $products = $this->productModel->getProducts();

        $data = [
            'title' => 'Cafeteria | Premium Drinks eCommerce',
            'css_file' => 'home.css',
            'products' => $products
        ];
        $this->view('home', $data);
    }
}