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
}
