<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\MPengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengeluaranCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Pengeluaran';

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

        $query  = MPengeluaran::query();
        $result = $query->get();

        $data['result'] = $result;
// return $data;
        return view('admin.pengeluaran', $data);
    }

    public function adminPortofolio() {

        $data['title'] = 'Admin Portofolio';

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

        $query              = MPortofolio::query();
        // $query              = $query->where('user_access', '=', 2);
        $resultPortofolio   = $query->get();

        $data['resultPortofolio'] = $resultPortofolio;

        return view('admin.portofolio', $data);
    }

    public function newPortofolio() {

        $data['title'] = 'New Portofolio';

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

        return view('admin.newPortofolio', $data);
    }

    public function createNewPortofolio(request $request) {

        $data['title'] = 'New Portofolio';

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
            $request['portofolio_photo']    = $imageName;
        }else{
            $request['portofolio_photo'] = 'default.png';
        }

        $data['success'] = 0;

        $validator = Validator::make($request->all(), [
            'portofolio_name'          => 'required|unique:portofolio',
            'portofolio_description'   => 'required',
        ]);

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;
            return view('admin.newPortofolio', $data);
        }else{
            $data['success'] = 1;
        }

        $new_portofolio = MPortofolio::create($request->all());
        
        if ($new_portofolio) {
            if ($request->image_file) {
                $request->image_file->move(base_path().'/public/assets/portofolio_photo/', $imageName);
            }   
        }

        return view('admin.newPortofolio', $data);
    }

    public function editPortofolio($id_package) {

        $data['title'] = 'Edit Portofolio';

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

        $package = MPortofolio::find($id_package);

        $data['portofolio'] = $package;

        return view('admin.editPortofolio', $data);
    }

    public function savePortofolio(request $request) {

        $data['title'] = 'Edit Portofolio';

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
            $request['portofolio_photo']    = $imageName;
        }else{
            $imageName = 'default.png';
            $request['portofolio_photo'] = $imageName;
        }

        $validator = Validator::make($request->all(), [
            'portofolio_name'          => 'required',
            'portofolio_description'   => 'required',
        ]);

        $package = MPortofolio::find($request->id_package);
        $data['portofolio'] = $package;

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;

            return view('admin.editPortofolio', $data);
        }else{
            $data['success'] = 1;
        }
        
        $updatePackage = MPortofolio::where('id_portofolio', '=', $request->id_portofolio)
                ->update(['portofolio_name' => $request->portofolio_name, 'portofolio_description' => $request->portofolio_description, 'portofolio_photo' => $imageName]);

        if ($updatePackage) {
            if ($request->image_file) {
                $request->image_file->move(base_path().'/public/assets/portofolio_photo/', $imageName);
            }   
        }

        $portofolio = MPortofolio::find($request->id_portofolio);
        $data['portofolio'] = $portofolio;

        return view('admin.editPortofolio', $data);
    }

    public function deletePortofolio(request $request) {

        $portofolio = MPortofolio::find($request->id_portofolio);
        $success = $portofolio->delete();

    }
}
