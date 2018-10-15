<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\MBooking;
use App\MPackage;
use App\MBookingPackage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Mail;
use Illuminate\Support\Facades\Validator;

class BookingCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['title'] = 'Booking';

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
        // $query         = $query->where('id_user', '=', $user->id_user);
        $resultPackage = $query->get();

        $data['resultPackage'] = $resultPackage;

        return view('dashboard.booking', $data);
    }

    public function statusBookingCustomer() {

        $data['title'] = 'Status Booking';

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

        $query         = MBooking::query();
        // $query         = $query->addSelect('package.package_name');
        $query         = $query->where('id_user', '=', $user->id_user);
        // $query         = $query->join('package', 'package.id_package', '=', 'booking_package.id_package');
        $resultBooking = $query->get();

        foreach ($resultBooking as $key => $value) {
            
            if ($resultBooking[$key]['status_booking'] == 0) {
                $resultBooking[$key]['status_booking'] = 'Waiting For Confirmation';
            }else if ($resultBooking[$key]['status_booking'] == 1) {
                $resultBooking[$key]['status_booking'] = 'Confirmed';
            }else if ($resultBooking[$key]['status_booking'] == 2) {
                $resultBooking[$key]['status_booking'] = 'Finished';
            }else if ($resultBooking[$key]['status_booking'] == 3) {
                $resultBooking[$key]['status_booking'] = 'Rejected';
            }

            $date = Carbon::parse($resultBooking[$key]['booking_date']);
            $resultBooking[$key]['booking_date'] = $date->toFormattedDateString();
            
        }

        $data['resultBooking'] = $resultBooking;
        return view('dashboard.statusBooking', $data);
    
    }

    public function bookingSelected($id_package, $event_date, $event_name, $event_location) {

        $data['title'] = 'Booking Confirmation';

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

        $date = Carbon::parse(base64_decode($event_date));

        // $data['id_package']     = $id_package;
        $data['event_date']         = base64_decode($event_date);
        $data['event_date_string']  = $date->toFormattedDateString();
        $data['event_name']         = base64_decode($event_name);
        $data['event_location']     = base64_decode($event_location);

        $id_packageArray = explode(',', $id_package);
        // return $id_packageArray;

        $package = [];
        $sum = 0;

        foreach ($id_packageArray as $key => $value) {
            $query         = MPackage::query();
            $query         = $query->where('id_package', '=', $value);
            $resultPackage = $query->get()->first();

            $resultPackage['package_price_string'] = "Rp " . number_format($resultPackage['package_price'],2,',','.');

            array_push($package, $resultPackage);

            $sum += $resultPackage['package_price'];

        }

        $data['package'] = $package;
        $data['total_price'] = "Rp " . number_format($sum,2,',','.');
        $data['total_price_int'] = $sum;
        $data['user'] = $user;
        // return $sum;

        // return $data;
        // return base64_decode($event_date); "Rp " . number_format($value['salary'],2,',','.');
        return view('dashboard.bookingConfirmation', $data);
    }

    public function bookingConfirmation(request $request) {

        // MBooking::create($request->all());

        $id = DB::table('booking')->insertGetId(
            [   'id_user'           => $request->id_user,
                'booking_date'      => $request->booking_date,
                'event_location'    => $request->event_location,
                'event_name'        => $request->event_name,
                'discount_offer'    => $request->discount_offer,
                'customer_offer'    => $request->customer_offer,
                'approved_offer'    => $request->approved_offer,
                'status_booking'    => $request->status_booking
            ]
        );

        if ($id) {
            
            foreach ($request->package as $key => $value) {
                DB::table('booking_package')->insert(
                    [   'id_package'      => $value,
                        'id_booking'      => $id
                    ]
                );
            }
        }else{
            return 0;
        }

        $data = array('name'=> 'rabit', "body" => "You have 1 new booking event");
   
        Mail::send('emails.mail', $data, function($message) {
            $message->to( 'captainjoko212@gmail.com' , 'Booking')
                    ->subject('Booking');
            $message->from('support@ikisoundsystem.com','IkI Sound System');
        });

        $response = array(
            // 'response' => $request->all(),
            'id' => $id
            );

        return $response;
        // return $insert;


        // return '$request->all()';
        // return $new_booking;
    }

    public function bookingFinished() {

        $data['title'] = 'Booking Finished';

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

        return view('dashboard.bookingFinished', $data);

    }

    public function adminBooking() {

        $data['title'] = 'Booking';

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
        // $query         = $query->where('id_user', '=', $user->id_user);
        $query         = $query->orderBy('booking.id_booking', 'desc');
        $query         = $query->join('users', 'users.id_user', '=', 'booking.id_user');
        $resultBooking = $query->get();

        foreach ($resultBooking as $key => $value) {
            $date = Carbon::parse($resultBooking[$key]['booking_date']);
            $resultBooking[$key]['booking_date'] = $date->toFormattedDateString();

            $resultBooking[$key]['customer_offer'] = "Rp " . number_format($resultBooking[$key]['customer_offer'],2,',','.');
            $resultBooking[$key]['approved_offer'] = "Rp " . number_format($resultBooking[$key]['approved_offer'],2,',','.');

            if ($resultBooking[$key]['status_booking'] == 0) {
                $resultBooking[$key]['status_booking'] = 'Waiting';
            }else if ($resultBooking[$key]['status_booking'] == 1) {
                $resultBooking[$key]['status_booking'] = 'Confirmed';
            }else if ($resultBooking[$key]['status_booking'] == 2) {
                $resultBooking[$key]['status_booking'] = 'Finished';
            }else if ($resultBooking[$key]['status_booking'] == 3) {
                $resultBooking[$key]['status_booking'] = 'Rejected';
            }

        }

        $data['resultBooking'] = $resultBooking;

        // return $resultBooking;

        return view('admin.booking', $data);

    }

    public function deleteBooking(request $request) {

        $booking = MBooking::find($request->id_booking);

        $success = $booking->delete();

    }

    public function bookingDetail($id_booking) {

        $data['title'] = 'Booking Detail';

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
        $query         = $query->where('booking.id_booking', '=', $id_booking);
        $query         = $query->join('users', 'users.id_user', '=', 'booking.id_user');
        $resultBooking = $query->get()->first();

        $date = Carbon::parse($resultBooking['booking_date']);
        $resultBooking['booking_date'] = $date->toFormattedDateString();

        $package = [];
        $sum = 0;
        
        $query         = MBookingPackage::query();
        $query         = $query->where('id_booking', '=', $id_booking);
        $query         = $query->join('package', 'package.id_package', '=', 'booking_package.id_package');
        $resultPackage = $query->get();

        foreach ($resultPackage as $key => $value) {
            # code...
            $resultPackage[$key]['package_price_string'] = "Rp " . number_format($value['package_price'],2,',','.');
            $sum += $resultPackage[$key]['package_price'];
        }

        // return $sum;

        $data['total_price_string'] = "Rp " . number_format($sum,2,',','.');
        $data['total_price_offer_string'] = "Rp " . number_format($resultBooking['customer_offer'],2,',','.');
        $data['total_price_approved_offer_string'] = "Rp " . number_format($resultBooking['approved_offer'],2,',','.');
        $data['resultBooking'] = $resultBooking;
        $data['resultPackage'] = $resultPackage;

        // return $data;

        return view('admin.bookingDetail', $data);
    }

    public function approveBooking($id_booking) {

        $data['title'] = 'Approve Booking';

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
        $query         = $query->where('id_booking', '=', $id_booking);
        $resultBooking = $query->get()->first();

        // return $resultBooking;
        $data['customer_offer'] = "Rp " . number_format($resultBooking['customer_offer'],2,',','.');
        $data['approved_offer'] = $resultBooking['approved_offer'];
        $data['id_booking'] = $id_booking;
        $data['status_booking'] = $resultBooking['status_booking'];

        $data['success'] = 0;
// return $data;
        return view('admin.approveBooking', $data);

    }

    public function approveBookingSave(request $request) {

        $data['title'] = 'Approve Booking';

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
        $query         = $query->where('id_booking', '=', $request['id_booking']);
        $resultBooking = $query->get()->first();

        $data['customer_offer'] = "Rp " . number_format($resultBooking['customer_offer'],2,',','.');
        $data['approved_offer'] = $resultBooking['approved_offer'];
        $data['id_booking'] = $request['id_booking'];
        $data['status_booking'] = $resultBooking['status_booking'];

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'price_approved' => 'required|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;

            return view('admin.approveBooking', $data);
        }else{
            $data['success'] = 1;
        }

        $booking = MBooking::find($request->id_booking);

        if ($request['status_booking'] == "") {
            $updatePackage = MBooking::where('id_booking', '=', $request->id_booking)
                ->update(['approved_offer' => $request->price_approved]);
        }else{
            $updatePackage = MBooking::where('id_booking', '=', $request->id_booking)
                ->update(['approved_offer' => $request->price_approved, 'status_booking' => $request->status_booking]);

            # NOTIF EMAIL

            if ($request->status_booking == 0) {
                $status_booking = 'WAITING';
            }else if ($request->status_booking == 1) {
                $status_booking = 'CONFIRMED';
            }else if ($request->status_booking == 2) {
                $status_booking = 'FINISHED';
            }else if ($request->status_booking == 3) {
                $status_booking = 'REJECTED';
            }

            $query         = User::query();
            $query         = $query->where('id_user', '=', $booking['id_user']);
            $resultUser    = $query->get()->first();

            // return $resultUser['email'];
            $emailAddress = $resultUser['email'];

            $dataEmail = array('name'=> $resultUser['fullname'], "body" => "Your Booking Status is : ".$status_booking."");
       
            Mail::send('emails.mail', $dataEmail, function($message) use ($emailAddress) {
                $message->to( $emailAddress , 'Your Booking Status has Changed')
                        ->subject('Your Booking Status has Changed');
                $message->from('radit@garudagames.com','IkI Sound System');
            });
        }

        $data['approved_offer'] = $request->price_approved;

        return view('admin.approveBooking', $data);
        
    }



}




















