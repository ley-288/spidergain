<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

//Added
use App\Http\Controllers\Frontend\Campagne\CampagneController;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }
}
