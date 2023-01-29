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
        $query = $this->db->table('mata_pelajaran');
        $query->select('guru.nama as nama_guru,mata_pelajaran.nama as nama_mapel,kelas,mata_pelajaran.id as id_mapel');
        $query->join('guru', 'mata_pelajaran.id = guru.mata_pelajaran_id')->where('mata_pelajaran.id', $id);
        return $query->get()->getRow();
    }
}
