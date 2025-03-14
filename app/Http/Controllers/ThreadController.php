<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::with('user', 'replies')->get();
        return view('threads.index', compact('threads'));
    }
}
