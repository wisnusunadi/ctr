<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function admin_dash()
    {
        echo view('admin/dashboard');
    }
    public function murid_dash()
    {

        echo view('murid/dashboard');
    }
}
