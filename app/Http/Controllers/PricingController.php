<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display the pricing page.
     */
    public function index()
    {
        return view('pricing');
    }
}
