<?php

class Controller{
    public function model($model){
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []){
        if(file_exists(__DIR__ . '/../Views/' . $view . '.php')){
            require_once __DIR__ . '/../Views/' . $view . '.php';
        } else {
            die("View $view does not exist.");
        }
    }
}