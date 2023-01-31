<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mata_pelajaran';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'kelas'];
    protected $useTimestamps = false;

    public function search($keyword)
    {
        return $this->table('mata_pelajaran')->like('nama', $keyword);
    }
    public function joinsGuru($id)
    {
        $query = $this->table('mata_pelajaran');
        $query->select('guru.nama as nama_guru,mata_pelajaran.nama as nama_mapel,kelas,mata_pelajaran.id as id_mapel');
        $query->join('guru', 'mata_pelajaran.id = guru.mata_pelajaran_id')->where('mata_pelajaran.id', $id);
        return $query->get()->getRow();
    }

    public function getSudahNilai($id_siswa, $kelas)
    {
        $query = $this->table('mata_pelajaran');
        $query->select('mata_pelajaran.kode as kode_mapel,mata_pelajaran.nama as nama_mapel,detail_murid.nilai');
        $query->join('detail_murid', 'mata_pelajaran.id = detail_murid.mapel_id', 'left');
        $query->where('mata_pelajaran.kelas', $kelas);
        $query->where('detail_murid.murid_id', $id_siswa);
        return $query->get()->getResult();
    }
    public function getBelumNilai($id_siswa, $kelas)
    {
        $db = db_connect();
        $sql = "SELECT  mata_pelajaran.kode as kode_mapel,mata_pelajaran.nama as nama_mapel,'Belum Dinilai' as nilai FROM mata_pelajaran WHERE NOT EXISTS (SELECT * FROM detail_murid where mata_pelajaran.id = detail_murid.mapel_id AND detail_murid.murid_id = $id_siswa) AND  mata_pelajaran.kelas = $kelas";
        $result =  $db->query($sql)->getResult();
        return $result;
    }

    public function getMapelGuru($keyword)
    {
        if ($keyword == 'semua' || $keyword == '') {
            $query = $this->table('mata_pelajaran');
            $query->select('mata_pelajaran.id, mata_pelajaran.kode as kode_mapel,mata_pelajaran.nama as nama_mapel , guru.nama as nama_guru , mata_pelajaran.kelas ');
            $query->join('guru', 'mata_pelajaran.id = guru.mata_pelajaran_id', 'left');
            return $query;
        } else {
            $query = $this->table('mata_pelajaran');
            $query->select('mata_pelajaran.id, mata_pelajaran.kode as kode_mapel,mata_pelajaran.nama as nama_mapel , guru.nama as nama_guru , mata_pelajaran.kelas ');
            $query->join('guru', 'mata_pelajaran.id = guru.mata_pelajaran_id', 'left');
            $query->like('mata_pelajaran.nama', $keyword);
            return $query;
        }
    }
}
