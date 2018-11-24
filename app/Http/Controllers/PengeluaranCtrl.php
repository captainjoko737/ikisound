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

        $query  = MPengeluaran::orderBy('id', 'DESC');
        $result = $query->get();

        $total = 0;
        foreach ($result as $key => $value) {
            $total += $value['jumlah'];
        }

        $data['total'] = $total;
        $data['result'] = $result;
// return $data;
        return view('admin.pengeluaran', $data);
    }

    public function add() {

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

        $data['success'] = 0;

        return view('admin.addPengeluaran', $data);
    }

    public function create(request $request) {

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

        $data['success'] = 1;

        $new_pengeluaran = MPengeluaran::create($request->all());

        return view('admin.addPengeluaran', $data);
    }


    public function editPengeluaran($id) {

        $data['title'] = 'Edit Pengeluaran';

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

        $pengeluaran = MPengeluaran::find($id);

        $data['pengeluaran'] = $pengeluaran;
// return $data;
        return view('admin.editPengeluaran', $data);
    }

    public function savePengeluaran(request $request) {

        $data['title'] = 'Edit Pengeluaran';

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

        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'jumlah'   => 'required',
        ]);

        $pengeluaran = MPengeluaran::find($request->id);
        $data['pengeluaran'] = $pengeluaran;

        if ($validator->fails()) {    
            $data['errors'] = $validator->messages();
            $data['success'] = 0;

            return view('admin.editPengeluaran', $data);
        }else{
            $data['success'] = 1;
        }
        
        $updatePengeluaran = MPengeluaran::where('id', '=', $request->id)
                ->update(['nama' => $request->nama, 'jumlah' => $request->jumlah]);

        $pengeluaran = MPengeluaran::find($request->id);
        $data['pengeluaran'] = $pengeluaran;

        return view('admin.editPengeluaran', $data);
    }

    public function deletePengeluaran(request $request) {

        $pengeluaran = MPengeluaran::find($request->id);
        $success = $pengeluaran->delete();

    }
}
