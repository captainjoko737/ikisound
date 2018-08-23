<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MPackage;
use App\MBooking;
use App\MCrewSalary;
use App\User;
use Illuminate\Support\Facades\Validator;
use Mail;
use Carbon\Carbon;

class AdminCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['title'] = 'Dashboard';

        $user = Auth::user();

        if ($user->user_access != 1 && $user->user_access != 2) {
            return redirect('/');
        }

        if ($user->user_access == 2) {
            # is Admin
            $data['isSuperAdmin'] = 'hidden';
        }else if ($user->user_access == 1) {
            # is Super Admin
            $data['isSuperAdmin'] = 'show';   
        }

        # GET TOTAL USER REGISTRATION

        $query      = User::query();
        $query      = $query->where('user_access', '>', 3);
        $resultUser = $query->get();

        $data['usersRegistration'] = count($resultUser);

        # GET TOTAL CREW PAYMENT

        $query      = MCrewSalary::query();
        // $query      = $query->where('user_access', '>', 3);
        $resultCrew = $query->get();

        $totalPayment = 0;

        foreach ($resultCrew as $key => $value) {
            $totalPayment += $resultCrew[$key]['salary']; 
        }

        $data['totalCrewPayment'] = "Rp " . number_format($totalPayment,2,',','.');

        # GET TOTAL SALDO

        $totalSaldo = 0;

        $query          = MBooking::query();
        $query          = $query->where('status_booking', '=', 2);
        $resultBooking  = $query->get();

        foreach ($resultBooking as $key => $value) {
            $totalSaldo += $value['approved_offer'];
        }

        $totalSaldo = $totalSaldo - $totalPayment;

        $data['totalSaldo'] = "Rp " . number_format($totalSaldo,2,',','.');

        return view('admin.dashboard', $data);
    }

    public function AllUser() {

        $data['title'] = 'All User';

        $user = Auth::user();

        if ($user->user_access != 1 && $user->user_access != 2) {
            return redirect('/');
        }

        if ($user->user_access == 2) {
            # is Admin
            $data['isSuperAdmin'] = 'hidden';
        }else if ($user->user_access == 1) {
            # is Super Admin
            $data['isSuperAdmin'] = 'show';
            
        }

        $query      = User::query();
        $query      = $query->where('user_access', '>', 2);
        $resultUser = $query->get();

        foreach ($resultUser as $key => $value) {
            # code...
            if ($resultUser[$key]['user_access'] == 3) {
                # code...
                $resultUser[$key]['user_access'] = 'Crew';
            } else if ($resultUser[$key]['user_access'] == 4) {
                # code...
                $resultUser[$key]['user_access'] = 'Customer';
            }
            
        }

        $data['resultUser'] = $resultUser;

        return view('admin.allUser', $data);

    }

    public function AllAdmin() {

        $data['title'] = 'All Admin';

        $user = Auth::user();

        if ($user->user_access != 1 && $user->user_access != 2) {
            return redirect('/');
        }

        if ($user->user_access == 2) {
            # is Admin
            $data['isSuperAdmin'] = 'hidden';
        }else if ($user->user_access == 1) {
            # is Super Admin
            $data['isSuperAdmin'] = 'show';
            
        }

        $query      = User::query();
        $query      = $query->where('user_access', '=', 2);
        $resultUser = $query->get();

        // return $resultUser;

        foreach ($resultUser as $key => $value) {
            # code...
             $resultUser[$key]['user_access'] = 'Admin';
            
        }

        $data['resultUser'] = $resultUser;

        return view('admin.allAdmin', $data);

    }

    public function CrewSalary() {

        $data['title'] = 'Crew Salary';

        $user = Auth::user();

        if ($user->user_access != 1 && $user->user_access != 2) {
            return redirect('/');
        }

        if ($user->user_access == 2) {
            # is Admin
            $data['isSuperAdmin'] = 'hidden';
        }else if ($user->user_access == 1) {
            # is Super Admin
            $data['isSuperAdmin'] = 'show';
            
        }

        $query              = MCrewSalary::query();
        // $query         = $query->addSelect('package.package_name');
        // $query              = $query->where('crew_salary.id_user', '=', $user->id_user);
        $query              = $query->join('booking', 'booking.id_booking', '=', 'crew_salary.id_booking');
        $query              = $query->join('users', 'users.id_user', '=', 'crew_salary.id_user');
        $resultCrewSalary   = $query->get();

        foreach ($resultCrewSalary as $key => $value) {
            
            if ($resultCrewSalary[$key]['status_salary'] == 0) {
                $resultCrewSalary[$key]['status_salary'] = 'Pending';
            }else if ($resultCrewSalary[$key]['status_salary'] == 1) {
                $resultCrewSalary[$key]['status_salary'] = 'Paid';
            }

            $date = Carbon::parse($resultCrewSalary[$key]['payment_date']);
            $resultCrewSalary[$key]['payment_date'] = $date->toFormattedDateString();

            $date = Carbon::parse($resultCrewSalary[$key]['booking_date']);
            $resultCrewSalary[$key]['booking_date'] = $date->toFormattedDateString();

            $resultCrewSalary[$key]['salary'] = "Rp " . number_format($value['salary'],2,',','.');
            
        }

        // return $resultCrewSalary;

        $data['resultCrewSalary'] = $resultCrewSalary;

        return view('admin.crewSalary', $data);

    }
    

    
}
