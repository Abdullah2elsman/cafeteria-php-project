<?php

class Home extends Controller{
    public function index(){
        $data = [
            'title' => 'Cafeteria | Premium Drinks eCommerce',
            'css_file' => 'home.css'
        ];
        $this->view('home', $data);
    }
}