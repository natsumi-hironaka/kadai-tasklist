<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // add

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
       $user = User::find($id);
       
       if (\Auth::user()->id === $user->user_id) {
       
        $kadaitasklists = $user->kadaitasklists()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'kadaitasklists' => $kadaitasklists,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
       }
       
       else {
           return redirect('/');
       }
    }
    
    
    
}