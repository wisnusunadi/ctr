<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MuridModel;
use App\Models\UserModel;
use Config\Services;

class LoginApp extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->muridModel = new MuridModel();
        $this->guruModel = new GuruModel();
        $this->validation = Services::validation();
        $this->session = Services::session();
    }

    public function login()
    {
        $header = 'SI | Login';
        echo  view('partial/header', ['header' => $header]);

        echo  view('/loginapp');
    }
    public function register()
    {
        $murid =   $this->muridModel->getBelumRegister();
        echo view('partial/header', ['murid' => $murid]);

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
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->userModel->save([
            'murid_id' => $data['nama'],
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
            if (password_verify($data['password'], $user['password'])) {
                if ($user['role'] == 'murid') {
                    $nama_user =  $this->muridModel->where('id', $user['murid_id'])->first();

                    $sessLogin = [
                        'id' =>  $nama_user['id'],
                        'nama' =>  $nama_user['nama'],
                        'isLogin' => true,
                        'username' => $user['username'],
                        'role' => $user['role']
                    ];
                } else {
                    $sessLogin = [
                        'id' =>  1,
                        'nama' =>  'Admin',
                        'isLogin' => true,
                        'username' => 'admin',
                        'role' => 'admin'
                    ];
                }


                $this->session->set($sessLogin);


                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/murid');
                }
            } else {
                session()->setFlashdata('password', 'Password salah');
                return redirect()->to('/');
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
    public function ganti_password()
    {
        return view('gantipwd');
    }
    public function ganti_password_store()
    {
        $data = $this->request->getPost();
        $validate = $this->validate([
            'pwd_lama' => 'required',
            'pwd_baru' => 'min_length[8]|alpha_numeric_punct|required',
            'pwd_baru2' => 'matches[pwd_baru]|required'
        ]);
        if (!$validate) {
            session()->setFlashdata('gagal', 'Cek Form Kembali');
            return redirect()->to('/gantipwd');
        }
        $user = $this->userModel->where('username', $this->session->get('username'))->first();

        if (password_verify($data['pwd_lama'], $user['password'])) {
            $password = password_hash($data['pwd_baru'], PASSWORD_DEFAULT);

            $this->userModel->save([
                "id" => $user['id'],
                "murid_id" => $user['murid_id'],
                "username" => $user['username'],
                "password" => $password,
                "role" => $user['role']
            ]);
            session()->setFlashdata('sukses', 'Cek Form Kembali');
            return redirect()->to('/gantipwd');
        } else {
            session()->setFlashdata('gagal', 'Password Lama Salah');
            return redirect()->to('/gantipwd');
        }
    }
}
