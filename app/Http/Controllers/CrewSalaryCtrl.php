<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MBooking;
use App\MCrewSalary;
use Carbon\Carbon;
use app\User;
use Illuminate\Support\Facades\Validator;


class CrewSalaryCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['title'] = 'Crew Salary';

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

        $query              = MCrewSalary::query();
        // $query         = $query->addSelect('package.package_name');
        $query              = $query->where('crew_salary.id_user', '=', $user->id_user);
        $query              = $query->join('booking', 'booking.id_booking', '=', 'crew_salary.id_booking');
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

        return view('dashboard.crewSalary', $data);
    }

    public function paidCrew() {

        $data['title'] = 'Crew Payment';

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

        $data['success'] = 0;

        $query         = MBooking::query();
        $query         = $query->where('status_booking', '=', 2);
        $resultBooking = $query->get();

        $query         = User::query();
        $query         = $query->where('id_user', '=', 3);
        $resultCrew    = $query->get();

        $data['resultCrew']     = $resultCrew;
        $data['resultBooking']  = $resultBooking;

        return view('admin.paidCrew', $data);

    }

    public function createNewCrewPayment(request $request) {

        $data['title'] = 'Crew Payment';

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

        $query         = MBooking::query();
        $query         = $query->where('status_booking', '=', 2);
        $resultBooking = $query->get();

        $query         = User::query();
        $query         = $query->where('id_user', '=', 3);
        $resultCrew    = $query->get();

        $data['resultCrew']     = $resultCrew;
        $data['resultBooking']  = $resultBooking;

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'id_booking'     => 'required',
            'salary'         => 'required|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('admin.paidCrew', $data);
        }else{
            $data['success'] = 1;
        }

        $request['user_access'] = 2;

        $date = Carbon::now();
        $date = $date->setTimezone('Asia/Phnom_Penh')->toDateString();

        $request['payment_date'] = $date;
        $request['status_salary'] = 1;

        $new_payment = MCrewSalary::create($request->all());

        return view('admin.paidCrew', $data);

    }

    public function deleteCrewSalary(request $request) {

        $crewSalary = MCrewSalary::find($request->id_crew_salary);

        $success = $crewSalary->delete();

    }
}
