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
}
