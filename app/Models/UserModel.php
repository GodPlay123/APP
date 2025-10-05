<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAccounts;

class UserModel extends Model
{

public static function UserAccount(){

    $userData = UserAccounts::select('users.full_name', 'users.email', 'users.password', 'roles.name', 'roles.description','roles.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->get();

        return $userData;
    }

public static function UserLogin($req){

    $username = $req->input('username');
    $userpassword = $req->input('password');

    $userExists = UserAccounts::where('email', $username)->exists();

    if (!$userExists) {
        return 'Not registered';
    } else {
        // Check if email and password match
        $validUser = UserAccounts::where('email', $username)
                     ->where('password', [$userpassword])
                    ->exists();

        if (!$validUser) {
            return 'Wrong password';
        } else {
            return 'Login successful';
        }
    }
}    

public static function InsertAccount($req){
  $email = $req->input('email');

    $userExists = UserAccounts::where('email', $email)->exists();

    if (!$userExists) {
        UserAccounts::insert([
            'full_name'   => $req->input('full_name'),
            'email'       => $email,
            'password'    => $req->input('password'),
            'role_id'     => $req->input('role'),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return 'User account created successfully';
    } else {
        return 'Email has already been used';
    }
}

public static function UpdateDelete($req, $id)
{
    $email = $req->input('email');

    if($id === 'update'){
            UserAccounts::where('email', $email)->update([
            'full_name'   => $req->input('full_name'),
            'password'    => $req->input('password'),
            'role_id'     => $req->input('role'),
            'updated_at'  => now(),
        ]);
        return 'User updated successfully';
    }
    elseif($id === 'delete'){
        UserAccounts::where('email', $email)->delete();
        return 'Delete Successfully';
    }
}
}
