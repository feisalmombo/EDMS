<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        $employees = DB::table('employees')
        ->select('*')
        ->get();

        $departments = DB::table('departments')
        ->select('*')
        ->get();

        $divisions = DB::table('divisions')
        ->select('*')
        ->get();

        $countries = DB::table('countries')
        ->select('*')
        ->get();

        $states = DB::table('states')
        ->select('*')
        ->get();

        $cities = DB::table('cities')
        ->select('*')
        ->get();

        return view('home')->with('employees',$employees)->with('departments',$departments)->with('divisions',$divisions)->with('countries',$countries)->with('states',$states)->with('cities',$cities);
        //return $states;
    }
}
