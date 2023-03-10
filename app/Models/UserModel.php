<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_id', 'murid_id', 'username', 'password', 'role'];
    protected $useTimestamps = false;
}
