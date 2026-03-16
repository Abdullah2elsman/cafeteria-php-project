<?php

class Users extends Controller {
    public function dashboard() {
        $this->view('users/dashboard');
    }

    public function orders() {
        $this->view('users/orders');
    }

    public function favorites() {
        $this->view('users/favorites');
    }

    public function history() {
        $this->view('users/history');
    }

    public function settings() {
        $this->view('users/settings');
    }
}
