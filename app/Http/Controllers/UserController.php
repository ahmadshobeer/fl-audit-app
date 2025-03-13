<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    //

    public function index(){
        // $users = User::orderBy('id', 'ASC')->get();
        $roles = Role::all(); // Mengambil semua role
       

        $users = User::with('role')->get();
        return view('menu.user',compact('users','roles'),['type_menu' => 'master','desk_menu'=>'Users']);

    }

    public function create()
    {
        $roles = Role::all(); // Mengambil semua role
        return view('menu.user', compact('roles'));
    }

    public function store(Request $request)
    {
        //
      
        $validatedData = $request->validate([
           'nama' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|exists:roles,id',
        ]);

       $validator = Validator::make($request->all(),[
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }  else{
            $users = User::create([
                'name' =>$validatedData['nama'],
                'username' =>$validatedData['username'],
                'email' =>$validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role_id' =>$validatedData['role'],
                
            ]); 
            $userWithRole = User::with('role')->find($users->id);
            return response()->json([
                'success'=>true,
                'message'=>'Data berhasil disimpan',
                'data'=>$userWithRole
            ]);

            print_r($userWithRole->toArray());
        }


       

    }

    public function edit($id)
{
    $user = User::with('role')->findOrFail($id);
    $roles = Role::all(); // Ambil semua role untuk dropdown

    return response()->json([
        'success' => true,
        'data' => $user,
        'roles' => $roles
    ]);
}


public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role_id' => 'required|exists:roles,id',
    ]);

    $user = User::findOrFail($id);
    $user->update($validatedData);

    // Ambil user terbaru dengan relasi role
    $userWithRole = User::with('role')->find($user->id);

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil diperbarui',
        'data' => $userWithRole
    ]);
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'User berhasil dihapus'
    ]);
}

}
