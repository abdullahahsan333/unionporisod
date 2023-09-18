<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['asideMenu']    = 'user';
        $data['asideSubmenu'] = 'all_user';

        $data['results'] = User::where('privilege', '!=', 'super')->get();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        return view('user.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['asideMenu']    = 'user';
        $data['asideSubmenu'] = 'add_user';
        
        $data['privilege'] = Auth::user()->privilege;
        
        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();

        //
        return view('user.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'privilege' => 'required',
            'username'  => 'required|unique:users|min:4',
            'password'  => 'required|confirmed|min:6'
        ]);

        $data = new User;

        $data->name        = $request->name;
        $data->mobile      = $request->mobile;
        $data->email       = $request->email;
        $data->address     = $request->address;
        
        $data->district_id = $request->district_id;
        $data->upazila_id  = $request->upazila_id;
        $data->union_id    = $request->union_id;
        
        $data->user_type   = $request->user_type;
        $data->privilege   = $request->privilege;
        $data->username    = $request->username;
        $data->password    = Hash::make($request->password);
        $data->avatar      = uploadFile($request->file('avatar'), 'public/uploads/user');

        $data->save();
        
        $userId = $data->id;
        if($request->privilege == 'user') {
            $data = New Privilege();
            
            $all_access = '
                {"dashboard":{"mainmenu":"dashboard","submenu":{"ward_no_1":"ward_no_1","ward_no_2":"ward_no_2",
                "ward_no_3":"ward_no_3","ward_no_4":"ward_no_4","ward_no_5":"ward_no_5","ward_no_6":"ward_no_6",
                "ward_no_7":"ward_no_7","ward_no_8":"ward_no_8","ward_no_9":"ward_no_9"}},"member":{"mainmenu":"member",
                "submenu":{"new_member":"new_member","all_member":"all_member","action":{"view":"view","edit":"edit",
                "report":"report","taxCollection":"taxCollection","delete":"delete"}}},"bazar_member":{"mainmenu":"bazar_member",
                "submenu":{"new_member":"new_member","all_member":"all_member","action":{"view":"view","edit":"edit",
                "delete":"delete"}}},"tax_collection":{"mainmenu":"tax_collection","submenu":{"add_tax":"add_tax","all_tax":"all_tax",
                "action":{"edit":"edit","delete":"delete"}}},"notice":{"mainmenu":"notice","submenu":{"add_notice":"add_notice",
                "all_notice":"all_notice","action":{"view":"view","edit":"edit","delete":"delete"}}},"report":{"mainmenu":"report",
                "submenu":{"tax_report":"tax_report","union_report":"union_report","member_wise_tax_report":"member_wise_tax_report",
                "ward_wise_tax_report":"ward_wise_tax_report","daily_tax_report":"daily_tax_report"}},"trade_license":{
                "mainmenu":"trade_license","submenu":{"add_trade":"add_trade","all_trade":"all_trade","action":{"edit":"edit",
                "delete":"delete"}}},"affidavit":{"mainmenu":"affidavit","submenu":{"citizenship_certificate":"citizenship_certificate",
                "inheritance_certificate":"inheritance_certificate","all_affidavit":"all_affidavit","action":{"view":"view",
                "edit":"edit","delete":"delete"}}},"sms":{"mainmenu":"sms","submenu":{"custom_sms":"custom_sms","send_sms":"send_sms",
                "sms_report":"sms_report"}},"chairman":{"mainmenu":"chairman","submenu":{"add_chairman":"add_chairman",
                "all_chairman":"all_chairman","action":{"edit":"edit","delete":"delete"}}}}
            ';
            
            $data->created   = date('Y-m-d');
            $data->privilege = 'user';
            $data->user_id   = $userId;
            $data->access    = $all_access;
            
            $data->save();
        }
        return redirect()->route('admin.user.create')->with(['success' => 'User successfully added.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['asideMenu']    = 'user';
        $data['asideSubmenu'] = 'all_user';
        
        $data['privilege'] = Auth::user()->privilege;
        
        $id = strDecode($id);
        
        $data['info'] = $info = User::find($id);
        
        $data['unions'] = DB::table('unions')->where('id', $info->union_id)->first();

        return view('user.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
        $data['privilege'] = Auth::user()->privilege;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = User::find($request->id);

        $data->name        = $request->name;
        $data->mobile      = $request->mobile;
        $data->email       = $request->email;
        $data->address     = $request->address;
        $data->user_type   = $request->user_type;
        
        $data->district_id = $request->district_id;
        $data->upazila_id  = $request->upazila_id;
        $data->union_id    = $request->union_id;
        
        $data->privilege   = $request->privilege;

        $data->save();
        
        return redirect()->route('admin.user.show', strEncode($request->id))->with(['success' => 'User successfully updated.']);
    }


    /**
     * change password the specified resource in storage.
     */
    public function changePassword(Request $request)
    {

        $data = User::find($request->id);

        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        if (!Hash::check($request->current_password, $data->password)) {
            return redirect()->route('admin.user.show', $request->id)->with(['warning' => 'Old password not match.']);
        }

        $data->password = Hash::make($request->password);

        $data->save();

        return redirect()->route('admin.user.show', strEncode($request->id))->with(['success' => 'Password change successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('admin.user')->with(['delete' => 'User successfully deleted.']);
    }

}
