<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $header = 'SI | Dashboard';
        echo view('partial/header', ['header' => $header]);
        echo view('partial/navbar');
        echo view('partial/sidebar');
        echo view('dashboard');
        echo view('partial/footer');
    }
}
