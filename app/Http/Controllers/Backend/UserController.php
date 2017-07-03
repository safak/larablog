<?php

namespace App\Http\Controllers\Backend;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;

class UserController extends BackendController
{

    public function index(Request $request){

        if (($status = $request->get('status')) && $status == 'admin') {

            $users = Role::find(5)->users()
                ->Latest()
                ->paginate(8);
            $statusList = $this->statusList();

        }

        elseif (($status = $request->get('status')) && $status == 'editor') {

            $users = Role::find(6)->users()
                ->Latest()
                ->paginate(8);
            $statusList = $this->statusList();

        }

        elseif (($status = $request->get('status')) && $status == 'author') {

            $users = Role::find(7)->users()
                ->Latest()
                ->paginate(8);
            $statusList = $this->statusList();

        }

        else{

            $users = User::with('posts')
                ->Latest()
                ->paginate(8);
            $statusList = $this->statusList();

        }

        return view('admin.user.index',compact('users','status','statusList'));

    }

    public function create(){

        return view('admin.user.create');

    }

    public function store(Request $request){

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->attachRole(Role::find($data['role']));

        return redirect()->route('admin.user.index')->with(['message'=> 'User Has Been Succesfully Created!']);


    }

    public function edit($id){

        $user = User::find($id);

        return view('admin.user.edit', compact('user'));

    }

    public function update(Request $request, $id){

        $user = User::find($id);
        $data = $request->all();
        $user->update($data);
        $user->detachRoles();
        $user->attachRole(Role::find($data['role']));
        return redirect()->route('admin.user.index')->with(['message'=> 'User Has Been Succesfully Updated!']);

    }

    public function deleteConfirm($id){

        $users = User::all();

        return view('admin.user.confirm', compact('id', 'users'));

    }

    public function destroy(Request $request, $id){

        $current_user = User::find($id);
        if ($id == 1 | $id == auth()->user()->id){

            return redirect()->route('admin.user.index')->with(['error-message'=> 'Default user cannot deleted!']);

        }
        $delete_option = $request['delete_option'];
        $selected_user = User::find($request['selected_user']);

        if ($delete_option == 'delete'){

            $current_user->posts()->forcedelete();

        }

        elseif ($delete_option == 'attribute'){

            $current_user->posts()->update(['author_id' => $selected_user->id]);

        }

        $current_user->delete();

        return redirect()->route('admin.user.index')->with(['message'=> 'User has been successfully deleted!!']);

    }

    private function statusList(){

        return [

            'all' => User::count(),
            'admin' => Role::find(5)->users()->count(),
            'editor' =>Role::find(6)->users()->count(),
            'author' => Role::find(7)->users()->count(),
        ];

    }
}
