<?php

namespace App\Models;

use CodeIgniter\Model;

class MuridModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'murid';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['no_induk', 'nama', 'tgl_lahir', 'jenis'];
    protected $useTimestamps = false;
}
