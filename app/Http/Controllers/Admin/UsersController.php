<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use App\UseCases\Auth\RegisterService;
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

    private $register;

    public function __construct(RegisterService $register)
    {
        $this-> register = $register;
//        $this->middleware('can:users-manage');
    }

    public function index(Request $request)
    {

        if (!empty($request->get('order_by') && $request->get('order')))
        {   $order_by = $request->get('order_by');
            $order = $request->get('order');
            $query = User::orderBy($order_by,$order);
        }
         else $query = User::orderByDesc('id');


        if(!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }

        if (!empty($value = $request->get('email'))){
            $query->where('email','like','%'.$value.'%');
        }

        if (!empty($value =  $request->get('status'))){
            $query->where('status',$value);
        }

        if (!empty($value = $request->get('role'))){
            $query->where('role',$value);
        }


       // dd($order_by);
        $users = $query->paginate(10);

        $statuses = User::statussesList();
        $sort_list = User::sortOrderList();
        $roles = User::roleList();
        return view('admin.users.index',compact('users','statuses','roles','sort_list'));
    }


    public function create()
    {
        $roles = User::roleList();
        return view('admin.users.create',compact('roles'));
    }


    public function store(CreateRequest $request)
    {

        $user = User::create($request->only(['name','email']) + [
                'password'=> bcrypt(Str::random()),
                'status' => User::STATUS_ACTIVE,
                'role' => $request->get('role')
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
