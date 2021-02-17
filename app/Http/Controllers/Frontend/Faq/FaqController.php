<?php

namespace App\Http\Controllers\Frontend\Faq;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller {

    public function index() {
         return view('frontend.faq.faq');
    }

}
