<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = User::get();
        return view('admin/user/index', compact('data'));
        
    }

    public function create()
    {
        
        return view('admin/user/create');
        
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil disimpan !']);
        return redirect()->route('list-user');
        
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin/user/edit', compact('data'));
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email|required|unique:users,id,'.$id,
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null)
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil diupdate !']);
        return redirect()->route('list-user');
        
    }

    public function delete($id)
    {
        $data = User::where('id', $id)->delete();
        \Session::flash('notif', ['level' => 'success','message' => 'Data user berhasil didelete !']);
        return redirect()->route('list-user');
        
    }
}
