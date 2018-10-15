<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\MPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PackageCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data['title'] = 'Package';

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

        $query          = MPackage::query();
        $resultPackage  = $query->get();
        // return $resultPackage;
        $data['resultPackage'] = $resultPackage;

        return view('dashboard.package', $data);
    }

    public function package() {

        $data['title'] = 'Admin Package';

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

        $query          = MPackage::query();
        $resultPackage  = $query->get();

        foreach ($resultPackage as $key => $value) {
            $resultPackage[$key]['package_price'] = "Rp " . number_format($value['package_price'],2,',','.');
        }

        $data['resultPackage'] = $resultPackage;

        return view('admin.package', $data);
    }

    public function newPackage() {

        $data['title'] = 'New Package';

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

        return view('admin.newPackage', $data);
    }

    public function createNewPackage(request $request) {

        $data['title'] = 'New Package';

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

        if ($request->image_file) {
            $imageName = time().'.'.$request->image_file->getClientOriginalExtension();
            $request['package_photo']    = $imageName;
        }else{
            $request['package_photo'] = 'default.png';
        }

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'package_name'          => 'required|unique:package',
            'package_description'   => 'required',
            'package_price'         => 'required|numeric',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('admin.newPackage', $data);
        }else{
            $data['success'] = 1;
        }

        $new_package = MPackage::create($request->all());
        
        if ($new_package) {
            if ($request->image_file) {
                $request->image_file->move(base_path().'/public/assets/package_photo/', $imageName);
            }   
        }

        return view('admin.newPackage', $data);
    }

    public function editPackage($id_package) {

        $data['title'] = 'Edit Package';

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

        $package = MPackage::find($id_package);

        $data['package'] = $package;

        return view('admin.editPackage', $data);
    }

    public function savePackage(request $request) {

        $data['title'] = 'Edit Package';

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
        
        if ($request->image_file) {
            $imageName = time().'.'.$request->image_file->getClientOriginalExtension();
            $request['package_photo']    = $imageName;
        }else{
            $imageName = 'default.png';
            $request['package_photo'] = $imageName;
        }

        $validator = Validator::make($request->all(), [
            'package_name'          => 'required|unique:package',
            'package_description'   => 'required',
            'package_price'         => 'required|numeric',
        ]);

        $package = MPackage::find($request->id_package);
        $data['package'] = $package;

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;

            return view('admin.editPackage', $data);
        }else{
            $data['success'] = 1;
        }
        
        $updatePackage = MPackage::where('id_package', '=', $request->id_package)
                ->update(['package_name' => $request->package_name, 'package_description' => $request->package_description, 'package_price' => $request->package_price, 'package_photo' => $imageName]);

        if ($updatePackage) {
            if ($request->image_file) {
                $request->image_file->move(base_path().'/public/assets/package_photo/', $imageName);
            }   
        }

        $package = MPackage::find($request->id_package);
        $data['package'] = $package;

        return view('admin.editPackage', $data);
    }

    public function deletePackage(request $request) {

        $package = MPackage::find($request->id_package);

        // return $package;

        $success = $package->delete();

        // if ($success) {
        //     # code...
        //     $image_path = '/public/assets/package_photo/1520337321.JPG';  // Value is not URL but directory file path
        //     if(File::exists($image_path)) {
        //         File::delete($image_path);
        //     }
        // }
        
        // $response = array(
        //     'response' => $success
        // );

        // return $response;
    }
}
