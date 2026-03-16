<?php

class Auth extends Controller{
    public function index(){
        $this->login();
    }
    public function login(){
        $this->view('auth/login');
    }
    public function register(){
        $this->view('auth/register');
    }
}