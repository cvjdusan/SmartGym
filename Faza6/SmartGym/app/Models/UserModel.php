<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
        protected $table      = 'Korisnik';
        protected $primaryKey = 'KorisnickoIme';
        protected $returnType = 'object';
        protected $allowedFields = ['KorisnickoIme', 'Sifra', 'ImePrezime', 'Mejl', 'DatumRodjenja', 'Tip', 'Status'];
    
}