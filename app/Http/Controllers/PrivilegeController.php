<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrivilegeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data['asideMenu'] = 'privilege';
        $data['asideSubmenu'] = $data['userName'] = '';
        
        $data['wards']    = DB::table('wards')->get();
        
        $data['user'] = User::where('privilege', '!=', 'super')->get();
        $data['privilege'] = Auth::user()->privilege;
        $data['accessInfo'] = $data['menuList'] = $data['submenuList'] = $menuList = [];
        
        if(!empty($request->_token)){ 
            $where = [];
            if(!empty($request->privilege)) {
                $where[] = ["privilege", $request->privilege];
            }
            if(!empty($request->user_id)) {
                $where[] = ["user_id", $request->user_id];
            }
            if(!empty($where)){
                $data['accessInfo'] = Privilege::where($where)->get();
            }
            $data['userName'] = User::where('id', $request->user_id)->select('id','name','username')->get();
        }
        foreach($data['accessInfo'] as $items) {
            $data['menuList'] = $menuList = json_decode($items->access); 
        }
        return view('privilege',$data);
    }

    
    public function store(Request $request) {
        if(!empty($request->user_id)) {
            $data = Privilege::where('user_id', $request->user_id)->first();
            if(empty($data)){
                $data = New Privilege();
            }
            
            /*foreach($_POST['menu'] as $key => $allitems){
                $data->$key = $allitems;
            }*/
            
            $all_access = json_encode($request->menu);
            //dd($request->menu);
            
            $data->created   = date('Y-m-d');
            $data->privilege = $request->privilege;
            $data->user_id   = $request->user_id;
            $data->access    = $all_access;
            
            $data->save();
    
            $message = ['success' => 'Privilege successful Save.'];
        }else{
            $message = ['success' => 'User Not Selected.'];
        }
        return redirect()->route('admin.privilege')->with($message);
    }
    
    public function userList(Request $request) {
        $option = '<option value="" selected>ইউজার নির্বাচন করুন</option>';
        if(!empty($request->privilege)){
            $results = DB::table('users')->where('privilege', $request->privilege)->get();
            if(!empty($results)){
                foreach($results as $row){
                    $option .= '<option value="'. $row->id .'">'. $row->name . ' ('. $row->username. ')' .'</option>';
                }
            }
        }
        echo $option;
    }
}