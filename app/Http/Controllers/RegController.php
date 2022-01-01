<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
{
    public function addPoll(Request $req)
    {
        $que = $req->get('que');
        $op1 = $req->get('op1');
        $op2 = $req->get('op2');
        $op3 = $req->get('op3');
        $op4 = $req->get('op4');

        DB::table('addpoll')->insert(
            ['question' => $que, 'op1' =>  $op1, 'op2' =>  $op2, 'op3' =>  $op3, 'op4' =>  $op4, 'status' =>  0]
        );

        return 'inserted';
    }
    public function displayPoll()
    {
        $poll = DB::table('addpoll')->get();
        return view('viewpoll', ['poll' => $poll]);
    }
    public function register(Request $req)
    {
        $uname = $req->get('email');
        $pass = $req->get('password');

        $user = DB::table('reg')->where('email', $uname)->where('password', $pass)->first();
        if ($user == null) {
            return "Wrond Id or Password";
        } else {
            return "success";
        }
    }
    public function user()
    {
        $POOL = DB::table('addpoll')->where(['status' => 1])->get();
        return view('user', ['pools' => $POOL]);
    }
}
