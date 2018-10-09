<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait AuthTrait {

    public function store($credentials) {
        $bcryptedPassword = bcrypt($credentials['password']);
        return DB::insert("INSERT INTO users (email, first_name, last_name, password) values ('{$credentials['email']}', '{$credentials['first_name']}', '{$credentials['last_name']}', '{$bcryptedPassword}')");
    }

    public function findById() {

    }

    public function findByEmail($email) {
        return DB::select("SELECT * FROM users WHERE email = '{$email}'");
    }

    // public function validatePassword($email, $password) {
    //     $data = DB::select("SELECT password FROM users WHERE email = '{$email}'");
    //     $user = $data[0];

    //     return $user->password == bcrypt($password);
    // }
}