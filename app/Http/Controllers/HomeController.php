<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Kid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::getUser();

        if ($user->role_id == 1) {
            $kids = \App\Kid::latest()->limit(50)->get();
            $title = 'Vėliausiai pridėti vaikai';
        } else {
            $kids = Kid::where('user_id', $user->id)->get();
            $title = 'Mano treniruojami vaikai';
        }

    //    $competitions = \App\Competition::latest()->limit(3)->get();
        $competitions = \App\Competition::orderBy('date', 'asc')->limit(3)->get();

        return view('home', compact('kids', 'competitions', 'title'));
    }
}
