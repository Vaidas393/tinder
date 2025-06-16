<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $me    = Auth::user();
        // pull everyone except yourself
        $users = User::where('id', '!=', $me->id)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('home', compact('me','users'));
    }
}
