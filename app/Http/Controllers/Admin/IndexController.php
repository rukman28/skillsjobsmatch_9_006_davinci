<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('admin.index', compact('users'));
    }


}
