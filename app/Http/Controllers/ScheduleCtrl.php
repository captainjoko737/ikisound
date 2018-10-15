<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\MSchedule;
use App\MBookingPackage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['title'] = 'Schedule';

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

        return view('dashboard.schedule', $data);
    }

    public function dataSchedule(request $request) {

        $query = MSchedule::query();
        // $query              = $query->where('user_question.best_time', '!=', '00:00:00');
        $query              = $query->join('users', 'users.id_user', '=', 'booking.id_user');
        $resultSchedule  = $query->get();

        foreach ($resultSchedule as $key => $value) {
            # code...
            $query                = MBookingPackage::query();
            $query                = $query->addSelect('package.package_name');
            $query                = $query->where('id_booking', '=', $value['id_booking']);
            $query                = $query->join('package', 'package.id_package', '=', 'booking_package.id_package');
            $resultBookingPackage = $query->get();

            // return $resultBookingPackage;

            $resultSchedule[$key]['booking_package'] = $resultBookingPackage;

            $date = new Carbon( $resultSchedule[$key]['booking_date'] ); 
            $resultSchedule[$key]['year'] = $date->year;
            $resultSchedule[$key]['month'] = $date->month - 1;
            $resultSchedule[$key]['day'] = $date->day;

            if ($resultSchedule[$key]['status_booking'] == 0) {

                $resultSchedule[$key]['status_booking_color'] = '#003bc0';
                $resultSchedule[$key]['status_booking'] = 'Waiting';

            }else if ($resultSchedule[$key]['status_booking'] == 1) {

                $resultSchedule[$key]['status_booking_color'] = '#19b804';
                $resultSchedule[$key]['status_booking'] = 'Confirmed';

            }else if ($resultSchedule[$key]['status_booking'] == 2) {

                $resultSchedule[$key]['status_booking_color'] = '#5074f7';
                $resultSchedule[$key]['status_booking'] = 'Finished';

            }else if ($resultSchedule[$key]['status_booking'] == 3) {

                $resultSchedule[$key]['status_booking_color'] = '#d80000';
                $resultSchedule[$key]['status_booking'] = 'Rejected';
            }
        }

        // return $resultSchedule;
    
        $response = array(
            'response' => $resultSchedule
        );

        return $response;
    }
}
















