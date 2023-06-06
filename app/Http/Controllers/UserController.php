<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('user.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',


        ]);

        $input = $request->all();




        User::create($input);

        return redirect()->route('user.index')
                        ->with('success','user created successfully.');
    }


    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }


    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }


    public function update(Request $request, Register $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            

        ]);

        $input = $request->all();




        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'user updated successfully.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
                        ->with('success','user deleted successfully');
    }








}