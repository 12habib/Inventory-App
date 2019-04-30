<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('users')
                    ->join('inventories','inventories.supplier_id','users.id')
                    ->select('users.name','inventories.product_name')
                    ->get();
        $user= Auth::user();
        if($user->role==='supplier'){
            $products =  User::join('inventories', function ($join)use($user) {
            $join->on('users.id', '=', 'inventories.supplier_id')
                 ->where('cinventories.supplier_id', '=', $user->id);
        })
        ->get();   
        }
         
        return view('home',compact('products'));
    }
}
