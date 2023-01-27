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
    public function guru_view()
    {

        echo view('admin/guru/index');
    }
    public function guru_create()
    {

        echo view('admin/guru/create');
    }
    public function mapel_view()
    {

        echo view('admin/mapel/index');
    }
    public function murid_view()
    {

        echo view('admin/murid/index');
    }
    public function rekap_nilai()
    {

        echo view('admin/rekap/nilai');
    }
}
