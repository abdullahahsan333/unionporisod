<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\SMSHelper;
use App\Models\SmsRecord;
use App\Models\Member;
use App\Models\BazarMember;
use App\Models\User;

class SmsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'sms';
        $data['asideSubmenu'] = 'smsReport';
        $data['sms_report']   = [];
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $where = [];

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        if (!empty($request->_token)) {
            
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }

            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }

            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
            }
        }

        if(!empty($request->form) && !empty($request->to))
        {
           $data['sms_report'] = SmsRecord::where($where)->select('is_send', 'sms', 'mobile', 'sending_date')->whereBetween('sending_date', array($request->form, $request->to))->get();
        }else{
            $data['sms_report'] = SmsRecord::where($where)->select('is_send', 'sms', 'mobile', 'sending_date')->get();
        }

        return view('sms.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_sms(Request $request) {
        $data['asideMenu']    = 'sms';
        $data['asideSubmenu'] = 'sendSms';
        $data['user_list']    = [];
        
                
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $where = [];

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        if (!empty($request->_token)) {
            
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }

            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }

            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
            }
            
            if(!empty($request->type)){
                if($request->type=='user'){
                    $data['memberList'] = User::where($where)->get();
                }
                if($request->type=='member'){
                    $data['memberList'] = Member::where($where)->get();
                }
                if($request->type=='bazar_member'){
                    $data['memberList'] = BazarMember::where($where)->get();
                }
            }
        }


        /*if(!empty($request->type)){
           if($request->type=="user"){
                $data['user_list'] =   User::where('status', 'unblock')->get();
           }
           if($request->type=="agent"){
                $data['user_list'] =   Agent::where('status', 'unblock')->get();
           }
        }*/

        return view('sms.send_sms', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom_sms() {
        $data['asideMenu'] = 'sms';
        $data['asideSubmenu'] = 'customSms';

        return view('sms.custom_sms',$data);
    }

    /* This method use for custom sms */
    public function submitSendSMS(Request $request) {
    	$mobile_no = explode(",", $request->mobiles);
    	$content = $request->message;

        foreach($mobile_no as $key => $num) {
            $success = SMSHelper::sendSMS($num, $content, $request->message_length);
        }

        if($success){
            return redirect()->route('admin.sms.custom_sms')->with(['success' => 'Sms Send successful.']);
        }else{
           return redirect()->route('admin.sms.custom_sms')->with(['error' => 'Sms Cold not sent successful.']);
        }
	}

	public function agentUserSendSms(Request $request) {
    	$mobile_no = $request->mobile;
    	$content = $request->message;

        foreach($mobile_no as $key => $num) {
            $success = SMSHelper::sendSMS($num, $content, $request->message_length);
        }
        if($success){
            return redirect()->route('admin.sms.send_sms')->with(['success' => 'Sms Send successful.']);
        }else{
           return redirect()->route('admin.sms.send_sms')->with(['error' => 'Sms Cold not sent successfully done.']);
        }
	}
}
