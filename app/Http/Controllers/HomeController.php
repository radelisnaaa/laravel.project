<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $events = Event::latest()->take(6)->get(); // Ambil data event (ubah sesuai kebutuhan)

        return view('home', compact('user', 'events'));
    }
}
