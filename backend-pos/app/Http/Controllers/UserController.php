<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pos.users');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return response()->json(['success' => true, 'message' => 'Create successfully']);
    }

    /**
     * delete user
     */
    public function deleteUser($id)
    {
        $deleted = User::where('id' ,$id)->delete();
        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }
    /**
     * update supplier
     */
    public function getSingleUser($id)
    {
        $user = User::where('id', $id)->get();
        return response()->json(['success' => true, 'data' => $user]);
    }

    public function updateUser(Request $request ,$id)
    {

        $request->validate([
            'name_edit' => 'nullable|string|max:255',
            'email_edit' => 'nullable',
            'password_edit' => 'nullable',
            'role_edit' => 'nullable'
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name_edit;
        if ($request->filled('password_edit')) {
            $user->password = Hash::make($request->password_edit);
        }
        $user->email = $request->email_edit;
        $user->role = $request->role_edit;

        $user->save();

        return response()->json(['success' => true, 'message' => 'Updated successfully']);
    }

}
