<?php

namespace App\Http\Controllers;
use App\Models\UserModel;


use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        if($req->input('Status') == 'login'){
            $user_data = UserModel::UserLogin($req);
            return response()->json($user_data);

        }else{
            $user_data = UserModel::UserAccount();
            return response()->json($user_data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_data_insert = UserModel::InsertAccount($request);
        return response()->json($user_data_insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_data_updatedelete = UserModel::UpdateDelete($request, $id);
        return response()->json($user_data_updatedelete);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
