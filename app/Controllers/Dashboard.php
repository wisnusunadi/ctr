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
        $currPage = $this->request->getVar('page_guru') ?  $this->request->getVar('page_guru') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $db = $this->guruModel->search($keyword);
        } else {
            $db =  $this->guruModel;
        }
        $data = [
            'guru' => $db->paginate(5, 'guru'),
            'pager' => $this->guruModel->pager,
            'currPage' => $currPage
        ];
        return view('admin/guru/index', $data);
    }
    public function guru_create()
    {
        $mapel =   $this->mapelModel->findAll();
        return view('admin/guru/create', ['mapel' => $mapel]);
    }
    public function guru_edit($id)
    {
        $data = [
            'guru' => $this->guruModel->find($id),
            'mapel' => $this->mapelModel->findAll()
        ];
        return view('admin/guru/edit', $data);
    }
    public function guru_update($id)
    {
        $data = $this->guruModel->find($id);
        $validate = $this->validate([
            'no_induk' => $data['no_induk'] ==  $this->request->getPost('no_induk') ? 'required' : 'is_unique[guru.no_induk]|required',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'jenis' => 'required',

        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/guru/edit/' . $id);
        }
        $this->guruModel->save([
            "id" => $id,
            "no_induk" => $this->request->getPost('no_induk'),
            "nama" => $this->request->getPost('nama'),
            "tgl_lahir" => $this->request->getPost('tgl_lahir'),
            "jenis" =>  $this->request->getPost('jenis'),
            "mata_pelajaran_id" =>  $this->request->getPost('mata_pelajaran_id')
        ]);
        session()->setFlashdata('sukses', 'Berhasil Diubah');
        return redirect()->to('/guru/edit/' . $id);
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
    public function guru_delete($id)
    {
        $this->guruModel->delete($id);
        session()->setFlashdata('delete', 'Berhasil Di hapus');
        return redirect()->to('/guru');
    }
    public function mapel_view()
    {
        $currPage = $this->request->getVar('page_mapel') ?  $this->request->getVar('page_mapel') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $db = $this->mapelModel->search($keyword);
        } else {
            $db =  $this->mapelModel;
        }
        $data = [
            'mapel' => $db->paginate(5, 'mapel'),
            'pager' => $this->mapelModel->pager,
            'currPage' => $currPage
        ];
        return view('admin/mapel/index', $data);
    }
    public function mapel_create()
    {
        return view('admin/mapel/create');
    }
    public function mapel_store()
    {
        $validate = $this->validate([
            'kode' => 'is_unique[mata_pelajaran.kode]|required',
            'kelas' => 'required',
            'nama' => 'required',
        ]);

        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/mapel/create');
        }
        $this->mapelModel->insert([
            "kode" => $this->request->getPost('kode'),
            "nama" => $this->request->getPost('nama'),
            "kelas" => $this->request->getPost('kelas'),
        ]);
        session()->setFlashdata('sukses', 'Berhasil Ditambahkam');
        return redirect()->to('/mapel/create');
    }
    public function mapel_edit($id)
    {
        $data = [
            'mapel' => $this->mapelModel->find($id),
        ];
        return view('admin/mapel/edit', $data);
    }
    public function mapel_update($id)
    {
        $data = $this->mapelModel->find($id);
        $validate = $this->validate([
            'kode' => $data['kode'] ==  $this->request->getPost('kode') ? 'required' : 'is_unique[mata_pelajaran.kode]|required',
            'nama' => 'required',
            'kelas' => 'required',

        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/mapel/edit/' . $id);
        }
        $this->mapelModel->save([
            "id" => $id,
            "kode" => $this->request->getPost('kode'),
            "nama" => $this->request->getPost('nama'),
            "kelas" => $this->request->getPost('kelas'),
        ]);
        session()->setFlashdata('sukses', 'Berhasil Diubah');
        return redirect()->to('/mapel/edit/' . $id);
    }
    public function mapel_delete($id)
    {
        $this->mapelModel->delete($id);
        session()->setFlashdata('delete', 'Berhasil Di hapus');
        return redirect()->to('/mapel');
    }
    public function murid_view()
    {
        $currPage = $this->request->getVar('page_murid') ?  $this->request->getVar('page_murid') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $db = $this->muridModel->search($keyword);
        } else {
            $db =  $this->muridModel;
        }
        $data = [
            'murid' => $db->paginate(5, 'murid'),
            'pager' => $this->muridModel->pager,
            'currPage' => $currPage
        ];
        return view('admin/murid/index', $data);
    }
    public function rekap_nilai()
    {

        return view('admin/rekap/nilai');
    }
}
