<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function admin_dash()
    {
        $header = 'SI | Dashboard';
        echo view('partial/header', ['header' => $header]);
        echo view('partial/navbar');
        echo view('partial/sidebar');
        echo view('admin/dashboard');
        echo view('partial/footer');
    }
    public function murid_dash()
    {
        $header = 'SI | Dashboard';
        echo view('partial/header', ['header' => $header]);
        echo view('partial/navbar');
        echo view('partial/sidebar');
        echo view('murid/dashboard');
        echo view('partial/footer');
    }
}
