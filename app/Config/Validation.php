<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $register = [
        'nama' => 'is_unique[user.murid_id]|required',
        'username' => 'alpha_numeric|is_unique[user.username]|required',
        'password' => 'min_length[8]|alpha_numeric_punct',
        'confirm' => 'matches[password]'
    ];

    public $register_errors = [
        'nama' => [
            'is_unique' => 'Siswa sudah terdaftar',
            'required' => 'Nama harus di isi'
        ],
        'username' => [
            'alpha_numeric' => 'Username hanya boleh mengandung huruf dan angka',
            'is_unique' => 'Username sudah dipakai',
            'required' => 'Username harus di isi'
        ],
        'password' => [
            'min_length' => 'Password harus terdiri dari 8 kata',
            'alpha_numeric_punct' => 'Password hanya boleh mengandung angka, huruf, dan karakter yang valid'
        ],
        'confirm' => [
            'matches' => 'Konfirmasi password tidak cocok'
        ]
    ];
}
