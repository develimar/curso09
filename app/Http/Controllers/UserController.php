<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function index(Request $request)
    {
//        $users = User::where('name', 'LIKE', "%{$request->search}%")->get();
        $search = $request->search;
        $users = $this->model->where(function ($query) use ($search){
            if ($search){
                $query->where('email', 'LIKE', "%{$search}%");
                $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->get();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
//        $user = User::where('id','=',$id)->first();
        if (!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = Arr::except($request->all(),'_token');
        $data['password'] = bcrypt($request->password);

        User::create($data);
        return redirect()->route('users.index');

    }

    public function edit($id)
    {
        if (!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        $data = $request->only('name','email');
        if ($request->password)
            $data['password'] = bcrypt($request->password);
        $user->update($data);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        if (!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }
        $user->delete();
        return redirect()->route('users.index');
    }
}
