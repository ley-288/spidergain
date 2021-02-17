<?php

namespace App\Http\Controllers\Condividi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CondividiController extends Controller {

    public function index() {
         return view('frontend.condividi');
    }

}