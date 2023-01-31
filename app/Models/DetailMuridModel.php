<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailMuridModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_murid';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['murid_id', 'mapel_id', 'kelas', 'nilai'];
    protected $useTimestamps = false;

    public function getSudahNilai($id)
    {
        $query = $this->table('detail_murid');
        $query->select('detail_murid.id,nilai,murid.nama as nama_murid');
        $query->join('murid', 'murid.id = detail_murid.murid_id');
        $query->where('detail_murid.mapel_id', $id);
        return $query->get()->getResult();
    }
}
