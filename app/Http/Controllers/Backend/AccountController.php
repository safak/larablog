<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends BackendController
{
    public function index(){

        $currentUser = Auth::user();

        return view('admin.account', compact('currentUser'));

    }

    public function edit(){

        $user = Auth::user();

        return view('admin.edit-account', compact('user'));

    }

    public function update(Request $request){

        $user = Auth::user();
        $data = $request->all();

        $user->update($data);

        return redirect()->route('admin.account.index')->with(['message'=> 'Account Has Been Succesfully Created!']);

    }
}
