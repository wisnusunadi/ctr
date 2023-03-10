<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailMuridModel;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MuridModel;
use Config\Database;
use Config\Services;
use Dompdf\Dompdf;
use PhpParser\Node\Stmt\TryCatch;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
        $this->muridModel = new MuridModel();
        $this->detailmuridModel = new DetailMuridModel();
        $this->guruModel = new GuruModel();
        $this->validation = Services::validation();
        $this->session = Services::session();
        $this->db = Database::connect();
    }


    public function admin_dash()
    {
        $data = [
            'murid' => $this->muridModel->findAll(),
            'guru' => $this->guruModel->findAll(),
            'mapel' => $this->mapelModel->findAll()
        ];
        return view('admin/dashboard', $data);
    }
    public function murid_dash()
    {
        $getMurid =  $this->muridModel->find($this->session->get('id'));
        $belumNilai =  $this->mapelModel->getBelumNilai($this->session->get('id'), $getMurid['kelas']);
        $sudahNilai =  $this->mapelModel->getSudahNilai($this->session->get('id'), $getMurid['kelas']);
        $data_nilai = array_merge($sudahNilai, $belumNilai);
        $data = [
            'murid' => $getMurid,
            'data_nilai' => $data_nilai,
        ];

        return view('murid/dashboard', $data);
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
            $db = $this->mapelModel->getMapelGuru($keyword);
        } else {
            $db =  $this->mapelModel->getMapelGuru('semua');
        }
        $data = [

            'mapel' => $db->paginate(5, 'mapel'),
            'pager' => $this->mapelModel->getMapelGuru('semua')->pager,
            'currPage' => $currPage,

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
        try {
            $this->mapelModel->delete($id);
            session()->setFlashdata('sukses', 'Berhasil Di hapus');
        } catch (\Throwable $th) {
            session()->setFlashdata('gagal', 'Gagal Di hapus');
        }
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

    public function murid_create()
    {
        return view('admin/murid/create');
    }
    public function murid_store()
    {
        $validate = $this->validate([
            'no_induk' => 'is_unique[murid.no_induk]|required',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'kelas' => 'required',

        ]);

        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/murids/create');
        }
        $this->muridModel->insert([
            "no_induk" => $this->request->getPost('no_induk'),
            "nama" => $this->request->getPost('nama'),
            "tgl_lahir" => $this->request->getPost('tgl_lahir'),
            "jenis" =>  $this->request->getPost('jenis'),
            "kelas" =>  $this->request->getPost('kelas')
        ]);
        session()->setFlashdata('sukses', 'Berhasil Ditambahkam');
        return redirect()->to('/murids/create');
    }
    public function murid_edit($id)
    {
        $data = [
            'murid' => $this->muridModel->find($id),
        ];
        return view('admin/murid/edit', $data);
    }
    public function murid_update($id)
    {
        $data = $this->muridModel->find($id);
        $validate = $this->validate([
            'no_induk' => $data['no_induk'] ==  $this->request->getPost('no_induk') ? 'required' : 'is_unique[murid.no_induk]|required',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'kelas' => 'required',

        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/murids/edit/' . $id);
        }
        $this->muridModel->save([
            "id" => $id,
            "no_induk" => $this->request->getPost('no_induk'),
            "nama" => $this->request->getPost('nama'),
            "tgl_lahir" => $this->request->getPost('tgl_lahir'),
            "jenis" =>  $this->request->getPost('jenis'),
            "kelas" =>  $this->request->getPost('kelas')
        ]);
        session()->setFlashdata('sukses', 'Berhasil Diubah');
        return redirect()->to('/murids/edit/' . $id);
    }
    public function murid_update_profile($id)
    {
        $data = $this->muridModel->find($id);
        $validate = $this->validate([
            'no_induk' => $data['no_induk'] ==  $this->request->getPost('no_induk') ? 'required' : 'is_unique[murid.no_induk]|required',
            'tgl_lahir' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'kelas' => 'required',

        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/murids/profile');
        }
        $this->muridModel->save([
            "id" => $id,
            "no_induk" => $this->request->getPost('no_induk'),
            "nama" => $this->request->getPost('nama'),
            "tgl_lahir" => $this->request->getPost('tgl_lahir'),
            "jenis" =>  $this->request->getPost('jenis'),
            "kelas" =>  $this->request->getPost('kelas')
        ]);
        session()->setFlashdata('sukses', 'Berhasil Diubah');
        return redirect()->to('/murids/profile');
    }
    public function murid_delete($id)
    {

        try {
            $this->muridModel->delete($id);
            session()->setFlashdata('sukses', 'Berhasil Di hapus');
        } catch (\Throwable $th) {
            session()->setFlashdata('gagal', 'Gagal Di hapus');
        }

        return redirect()->to('/murids');
    }
    public function mapel_nilai($id)
    {
        $kelas =  $this->mapelModel->joinsGuru($id)->kelas;
        $data = [
            'detail' => $this->mapelModel->joinsGuru($id),
            'murid_belum' => $this->muridModel->getBelumNilai($kelas, $id),
            'murid_done' => $this->detailmuridModel->getSudahNilai($id)
        ];
        return view('admin/mapel/nilai', $data);
    }
    public function mapel_nilai_store()
    {
        // dd($this->request->getPost());
        // $data = [
        //     [
        //         'murid_id' => 1,
        //         'mapel_id'  => 4,
        //         'kelas'  => 1,
        //         'nilai'  => 80
        //     ],
        // ];
        // dd($data);
        try {
            $builder = $this->db->table('detail_murid');

            for ($i = 0; $i < count($this->request->getPost('murid_id')); $i++) {
                if ($this->request->getPost('nilai')[$i] != '') {
                    $data[] = array(
                        'murid_id' => $this->request->getPost('murid_id')[$i],
                        'mapel_id'  => $this->request->getPost('mapel_id'),
                        'kelas'  => $this->request->getPost('kelas'),
                        'nilai'  => $this->request->getPost('nilai')[$i]
                    );
                }
            }

            // dd($data);
            $builder->insertBatch($data);
            session()->setFlashdata('sukses', 'Berhasil Ditambahkam');
            return redirect()->to('/mapel/nilai/' . $this->request->getPost('mapel_id'));
        } catch (\Throwable $th) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/mapel/nilai/' . $this->request->getPost('mapel_id'));
        }
    }

    public function mapel_nilai_delete($id)
    {
        $get = $this->detailmuridModel->find($id);
        $this->detailmuridModel->delete($id);
        session()->setFlashdata('sukses', 'Berhasil Di hapus');
        return redirect()->to('/mapel/nilai/' . $get['mapel_id']);
    }

    public function pdf_nilai()
    {
        $getMurid =  $this->muridModel->find($this->session->get('id'));
        $belumNilai =  $this->mapelModel->getBelumNilai($this->session->get('id'), $getMurid['kelas']);
        $sudahNilai =  $this->mapelModel->getSudahNilai($this->session->get('id'), $getMurid['kelas']);
        $data_nilai = array_merge($sudahNilai, $belumNilai);
        $data = [
            'murid' => $getMurid,
            'data_nilai' => $data_nilai,
        ];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('murid/laporan', $data));
        $dompdf->setPaper('A4', 'p');
        $dompdf->render();
        $dompdf->stream("Laporan Nilai", array("Attachment" => false));
    }

    public function rekap_nilai()
    {
        return view('admin/rekap/nilai');
    }
    public function profile()
    {
        $data = [
            'murid' => $this->muridModel->find($this->session->get('id')),
        ];
        return view('murid/profile', $data);
    }
}
