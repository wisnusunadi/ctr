<?php

namespace App\Models;

use CodeIgniter\Model;

class MuridModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'murid';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['no_induk', 'nama', 'tgl_lahir', 'jenis', 'kelas'];
    protected $useTimestamps = false;

    public function search($keyword)
    {
        return $this->table('murid')->like('nama', $keyword);
    }

    public function getbyKelas($id)
    {
        $query = $this->db->table('murid');
        $query->select('nama,id');
        $query->where('kelas', $id);
        return $query->get()->getResult();
    }
}
