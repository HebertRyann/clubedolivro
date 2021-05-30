<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Response;

class UsersController extends Controller
{
    public function index() {
        $list_users = Users::all();
        return Response::json($list_users, 200);
    }

    public function store(Request $request) {
        $list_users = Users::all();
        $find_user = Users::where('email', '=', $request->email)->first();
        if($find_user) {
            return Response::json($find_user, 200);
        } else {
            Users::create($request->all());
            return Response::json($request->all(),200);
        };
        
    }
}
