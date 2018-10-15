<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\MBooking;
use App\MCrewSalary;
use Illuminate\Support\Facades\Auth;
// use Validator;
use Illuminate\Support\Facades\Validator;
use Mail;
use Carbon\Carbon;

class UserCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {

        $data['title'] = 'Login';

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

        return view('auth.login', $data);
    }

    public function register() {

        $data['title'] = 'Register';

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
        
        $data['success'] = 0;

        return view('auth.register', $data);
    }

    public function createAccount(request $request, User $user) {
        
        $data['title'] = 'Register';

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

        $validator = Validator::make($request->all(), [
            'username' => array('required',
                             'unique:users',
                             'max:16',
                             'min:3',
                             'regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'password'   => 'required',
            'fullname'   => 'required',
            'email'      => 'required|unique:users',
            'address'    => 'required',
            'phone'      => 'required|unique:users|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('auth.register', $data);
        }else{
            $data['success'] = 1;
        }

        $request['password'] = bcrypt($request->password);
        $request['user_access'] = 4;

        $new_user = User::create($request->all());

        return view('auth.register', $data);
    }

    public function forgetPassword() {

        $data['title'] = 'Forget Password';

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

        $data['success'] = 0;
        $data['error'] = 0;

        return view('auth.forgetPassword', $data);

    }

    public function confirmForgetPassword(request $request, User $user) {
        
        $data['title'] = 'Forget Password';

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

        $query      = User::query();
        $query      = $query->where('username', '=', $request->username);
        $resultUser = $query->get();

        if (!$resultUser->first()) {
            $data['error'] = 'Username not found';
            $data['success'] = 0;
            return view('auth.forgetPassword', $data);
        }else{

            $this->resetPassword($resultUser->first());

            $data['error'] = 0;
            $data['success'] = 1;

            return view('auth.forgetPassword', $data);

            
        }

        return view('auth.register', $data);
    }

    public function resetPassword($user) {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(10, 99)
            . mt_rand(10, 99)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);

        $password = bcrypt($string);

        $updateUser = User::where('id_user', '=', $user['id_user'])
                ->update(['password' => $password]);

        $emailAddress = $user['email'];

        $data = array('name'=> $user['fullname'], "body" => "Your new password is : ".$string."");
   
        Mail::send('emails.mail', $data, function($message) use ($emailAddress) {
            $message->to( $emailAddress , 'Forget Password')
                    ->subject('Forget Password');
            $message->from('support@ikisoundsystem.com','IkI Sound System');
        });

    }

    Public function myProfile() {

        $data['title'] = 'My Profile';

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

        $query         = User::query();
        // $query         = $query->addSelect('package.package_name');
        $query         = $query->where('id_user', '=', $user->id_user);
        // $query         = $query->join('package', 'package.id_package', '=', 'booking_package.id_package');
        $resultUser = $query->get()->first();

        $data['user'] = $resultUser;

        return view('dashboard.myProfile', $data);
    }

    public function updateProfile($id_user) {

        $data['title'] = 'Update Profile';

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
        
        $data['success'] = 0;

        $user = User::find($id_user);

        // return $user;

        $data['user'] = $user;

        return view('dashboard.updateProfile', $data);
    }

    public function saveUpdateProfile(request $request) {

        // return $request->all();

        $data['title'] = 'Update Profile';

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

        $validator = Validator::make($request->all(), [
            'username' => array('required',
                             'max:16',
                             'min:3',
                             'regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'fullname'   => 'required',
            'email'      => 'required',
            'address'    => 'required',
            'phone'      => 'required|numeric',
        ]);

        $user = User::find($request->id_user);
        $data['user'] = $user;

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;

            return view('dashboard.updateProfile', $data);
        }else{
            $data['success'] = 1;
            
        }

        if ($request->password) {
            $newPassword = [];
            $params = ['username' => $request->username, 'fullname' => $request->fullname, 'email' => $request->email, 'address' => $request->address, 'password' => bcrypt($request->password)];
        }else{
            $params = ['username' => $request->username, 'fullname' => $request->fullname, 'email' => $request->email, 'address' => $request->address];
        }

        $updateUser = User::where('id_user', '=', $request->id_user)
                ->update($params);

        $user = User::find($request->id_user);
        $data['user'] = $user;

        return view('dashboard.updateProfile', $data);
    }
    # ADMIN

    public function newUserCrew(request $request) {

        $data['title'] = 'Create New Crew';

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

        return view('admin.newUser', $data);
    }

    public function createNewCrew(request $request) {

        $data['title'] = 'Create New Crew';

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

        $validator = Validator::make($request->all(), [
            'username' => array('required',
                             'unique:users',
                             'max:16',
                             'min:3',
                             'regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'password'   => 'required',
            'fullname'   => 'required',
            'email'      => 'required|unique:users',
            'address'    => 'required',
            'phone'      => 'required|unique:users|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('admin.newUser', $data);
        }else{
            $data['success'] = 1;
        }

        $request['password'] = bcrypt($request->password);
        $request['user_access'] = 3;

        $new_crew = User::create($request->all());

        return view('admin.newUser', $data);

    }

    public function deleteUser(request $request) {

        $user = User::find($request->id_user);

        $success = $user->delete();

    }

    public function newUserAdmin(request $request) {

        $data['title'] = 'Create New Admin';

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

        return view('admin.newAdmin', $data);
    }

    public function createNewAdmin(request $request) {

        $data['title'] = 'Create New Admin';

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

        $request['password'] = bcrypt($request->password);
        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'username' => array('required',
                             'unique:users',
                             'max:16',
                             'min:3',
                             'regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'password'   => 'required',
            'fullname'   => 'required',
            'email'      => 'required|unique:users',
            'address'    => 'required',
            'phone'      => 'required|unique:users|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('admin.newAdmin', $data);
        }else{
            $data['success'] = 1;
        }

        $request['user_access'] = 2;

        $new_admin = User::create($request->all());

        return view('admin.newAdmin', $data);

    }

    public function deleteAdmin(request $request) {

        $user = User::find($request->id_user);

        $success = $user->delete();

    }

    


}






















