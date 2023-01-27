<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginApp extends BaseController
{
    public function index()
    {
        $header = 'SI | Login';
        echo view('partial/header', ['header' => $header]);

        echo view('loginapp');
    }
}
