<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoansController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('loan');
    }
    public function search()
    {
        return view('loan');
    }
    public function store()
    {
        return view('loan');
    }
    public function list()
    {
        return view('loan');
    }
}
