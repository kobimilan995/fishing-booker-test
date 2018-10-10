<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait AuthTrait {

    public function store($credentials) {
        $bcryptedPassword = bcrypt($credentials['password']);

        $role_id = DB::select("SELECT role_id FROM roles where role_name = 'User'")[0]->role_id;
        return DB::insert("INSERT INTO users (email, first_name, last_name, password, role_id) values ('{$credentials['email']}', '{$credentials['first_name']}', '{$credentials['last_name']}', '{$bcryptedPassword}', '{$role_id}')");
    }

    public function findByEmail($email) {
        return DB::select("SELECT * FROM users WHERE email = '{$email}'");
    }

    public function findByEmailWithRole($email) {
        return DB::select("SELECT * 
        FROM users 
        INNER JOIN roles ON users.role_id = roles.role_id
        WHERE users.email = '{$email}'");
    }
}