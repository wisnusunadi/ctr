<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginApp extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        $header = 'SI | Login';
        echo view('partial/header', ['header' => $header]);

        echo view('/loginapp');
    }
    public function register()
    {
        $header = 'SI | Register';
        echo view('partial/header', ['header' => $header]);

        echo view('/registerapp');
    }


    public function store_register()
    {
        $data = $this->request->getPost();
        $this->validation->run($data, 'register');

        $errors = $this->validation->getErrors();

        if ($errors) {
            session()->setFlashdata('error', $errors);
            return redirect()->to('register');
        }
        $password = md5($data['password']);

        $this->userModel->save([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => $password,
        ]);
        session()->setFlashdata('login', 'Anda berhasil mendaftar, silahkan login');
        return redirect()->to('/');
    }

    public function store_login()
    {
        $data = $this->request->getPost();
        $user = $this->userModel->where('username', $data['username'])->first();

        if ($user) {
            if ($user['password'] != md5($data['password'])) {
                session()->setFlashdata('password', 'Password salah');
                return redirect()->to('/');
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set($sessLogin);


                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/murid');
                }
            }
        } else {
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->to('/');
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
