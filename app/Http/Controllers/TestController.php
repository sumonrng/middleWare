<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        echo "<pre>";
        print_r(session()->all());
        echo "</pre>";
        // session()->only(['name']);
        // if(session()->exists('name')){
        //     echo "Session has";
        // }else{
        //     echo "Session Null";
        // }
    }
    public function storeSession()
    {
        session(['name'=>'sumon']);
        session()->put('class','success');
        // session()->increment('count');
        session()->regenerate();
        session()->decrement('count',$decriment = 4);
        return redirect()->route('session');
    }
    public function deleteSession()
    {
        // session()->forget('name');
        session()->flush();
        return redirect()->route('session');
    }
}
