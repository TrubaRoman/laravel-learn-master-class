<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 * @property User $user
 */

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(20);
        return view('admin.users.index',compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(CreateRequest $request)
    {

        $user = User::create($request->only(['name','email']) + [
                'password'=> bcrypt(Str::random()),
                'status' => User::STATUS_ACTIVE,
                'role' => User::ROLE_USER
            ]);

        return redirect()->route('admin.users.show',$user);
    }


    public function show(User $user)
    {

        return view('admin.users.show',compact('user'));
    }

    public function edit(User $user)
    {

        $roles = User::roleList();

        return view('admin.users.edit',compact('user','roles'));
    }


    public function update(UpdateRequest $request, User $user)
    {

        $user->update($request->only(['name','email','status']));

        if ($request['role'] !== $user->role){
            $user->changeRole($request['role']);
        }

        return redirect()->route('admin.users.show',$user);
    }


    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {

        $user->statusToggle();

        return redirect()->back();
    }

}
