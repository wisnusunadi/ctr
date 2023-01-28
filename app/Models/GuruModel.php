<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'guru';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['no_induk', 'nama', 'tgl_lahir', 'jenis', 'mata_pelajaran_id'];
    protected $useTimestamps = false;

    public function search($keyword)
    {
        return $this->table('guru')->like('nama', $keyword);
    }
}
