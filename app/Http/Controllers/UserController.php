<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ];
        $user = User::create($data);
        if ($user) {
            return redirect()->route('users.index')->with('success', 'User created successfully');
        } else {
            return  redirect()->route('users.index')->with('error', 'User creation failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            return view('users.edit', compact('user'));
        } else {
            return redirect(url()->previous());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = [
            'email' => $request['email'],
            'name' => $request['name'],
        ];

        if ($user) {
            $user->update($data);
            return redirect()->route('users.index')->with('success', 'update user successfully');
        } else {
            return redirect(url()->previous())->with('error', 'There was an error updating');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'delete user successfully');
        } else {
            return redirect(url()->previous())->with('error', 'There was an error deleting');
        }
    }
}
