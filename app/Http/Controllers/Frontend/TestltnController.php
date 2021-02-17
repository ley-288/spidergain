<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\Campagne\CampagneController;

/**
 * Class HomeController.
 */
class TestltnController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //return view('frontend.index');
        return redirect(route('frontend.testltn'));
    }
}

