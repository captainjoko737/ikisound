<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MPackage;
use App\MPortofolio;


class LandingPageCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $data['title'] = 'Landing Page';

        $user = Auth::user();

        if ($user != null) {
            $data['isLogin'] = 'show';
            $data['isLogout'] = 'hidden';
            $data['username'] = $user->username;

            if ($user->user_access == 1) {
                # Super Admin
                $data['admin_area'] = 'show';
                $data['crew_salary'] = 'hidden';
                $data['statusBooking'] = 'hidden';
            }else if ($user->user_access == 2) {
                # Admin
                $data['admin_area'] = 'show';
                $data['crew_salary'] = 'hidden';
                $data['statusBooking'] = 'hidden';
            }else if ($user->user_access == 3) {
                # Crew
                $data['admin_area'] = 'hidden';
                $data['crew_salary'] = 'show';
                $data['statusBooking'] = 'hidden';
            }else if ($user->user_access == 4) {
                # Customer
                $data['statusBooking'] = 'show';
                $data['admin_area'] = 'hidden';
                $data['crew_salary'] = 'hidden';
            }
        }else{
            $data['isLogin'] = 'hidden';
            $data['isLogout'] = 'show';
            $data['username'] = '';
            $data['statusBooking'] = 'hidden';
            $data['admin_area'] = 'hidden';
            $data['crew_salary'] = 'hidden';
        }

        $query         = MPackage::query();
        $resultPackage = $query->get()->take(3);

        $query            = MPortofolio::query();
        $resultPortofolio = $query->get()->take(3);

        $data['resultPortofolio']   = $resultPortofolio;
        $data['resultPackage']      = $resultPackage;

        // return $data;

        return view('dashboard.landingPage', $data);
    }

    
}
