<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index() {
        return view('restaurants.index', [
            'restaurants' => Restaurant::all()
        ]);
    }

    public function create() {
        return view('restaurants.create');
    }

    public function store(Request $request) {
        Restaurant::create( $request->all() );
        
        return redirect()->route('restaurants.index');
    }
}
