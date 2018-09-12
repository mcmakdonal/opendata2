<?php

namespace App\Http\Controllers;

use App\Libs\Customlib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Validator;
use App\userdownload;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Home',
            'header' => 'Dashboard',
        ]);
    }

    public function login()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function chk_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:250',
            'password' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tbl_administrator = DB::table('tbl_administrator')->where('username', $request->username)->get()->toArray();
        if (count($tbl_administrator) === 0) {
            return redirect()->back()->withErrors(array('error' => 'error'));
        }
        if ($request->password === Crypt::decryptString($tbl_administrator[0]->password)) {
            return redirect("/")->cookie('token', $tbl_administrator[0]->admin_id, 14660)->cookie('name', $tbl_administrator[0]->first_name, 14660);
        } else {
            return redirect()->back()->withErrors(array('error' => 'error'));
        }
    }

    public function is_login()
    {
        return response()->json([
            'status' => Customlib::is_login(),
        ]);
    }

    public function user_download(Request $request)
    {
        $args = [
            'res_id' => $request->res_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'description' => $request->description,
            'create_date' => date('Y-m-d H:i:s'),
            'create_by' => 1,
            'update_date' => date('Y-m-d H:i:s'),
            'update_by' => 1,
            'record_status' => 'A',
        ];

        $result = DB::table('tbl_userdownload')->insert($args);
        if ($result) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function list_user()
    {

        userdownload::create(['name' => 'Flight 10']);

        // $userdownload = userdownload::find(2);

        // $userdownload->res_id = 3;
        // $userdownload->first_name = "first_name2";
        // $userdownload->last_name = "last_name2";
        // $userdownload->description = "description2";
        // $userdownload->update_by = 1;
        // $userdownload->record_status = "A";

        // $userdownload->save();


        dd($userdownload);
    }
}
