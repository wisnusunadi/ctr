<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MuridModel;
use Config\Services;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
        $this->muridModel = new MuridModel();
        $this->guruModel = new GuruModel();
        $this->validation = Services::validation();
        $this->session = Services::session();
    }


    public function admin_dash()
    {
        return view('admin/dashboard');
    }
    public function murid_dash()
    {

        return view('murid/dashboard');
    }
    public function guru_view()
    {
        return view('admin/guru/index');
    }
    public function guru_create()
    {
        $mapel =   $this->mapelModel->findAll();
        return view('admin/guru/create', ['mapel' => $mapel]);
    }
    public function guru_store()
    {
        $validate = $this->validate([
            'no_induk' => 'is_unique[guru.no_induk]|required',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'jenis' => 'required',

        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/guru/create');
        }
        $this->guruModel->insert([
            "no_induk" => $this->request->getPost('no_induk'),
            "nama" => $this->request->getPost('nama'),
            "tgl_lahir" => $this->request->getPost('tgl_lahir'),
            "jenis" =>  $this->request->getPost('jenis'),
            "mata_pelajaran_id" =>  $this->request->getPost('mata_pelajaran_id')
        ]);
        session()->setFlashdata('sukses', 'Berhasil Ditambahkam');
        return redirect()->to('/guru/create');
    }
    public function mapel_view()
    {

        return view('admin/mapel/index');
    }
    public function murid_view()
    {

        return view('admin/murid/index');
    }
    public function rekap_nilai()
    {

        return view('admin/rekap/nilai');
    }
}
