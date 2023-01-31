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

    public function getBelumNilai($kelas, $mapel)
    {
        $db = db_connect();
        $sql = "SELECT * FROM murid WHERE NOT EXISTS (SELECT * FROM detail_murid where murid.id = detail_murid.murid_id AND detail_murid.mapel_id = $mapel) AND murid.kelas = $kelas";
        $result =  $db->query($sql)->getResult();
        return $result;
    }
}
