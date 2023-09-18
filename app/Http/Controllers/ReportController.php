<?php
namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\BazarMember;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Tax Report
     */
    public function tax(Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'taxReport';
        
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $where = [];

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        return view('reports.tax', $data);
    }
    
    /**
     * Union Report
     */
    public function union_report (Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'unionReport';
        
        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $unionId = '';
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $unionId = $userInfo->union_id;
                $where[] =  ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'householder')->where($where)->get();
        
        if (!empty($request->_token)) {

            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }

            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }

            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }

            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }

            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
                $unionId = $request->union_id;
            }

            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }

            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            
            if (!empty($request->date_from)) {
                $where[] = ['created', '>=', $request->date_from];
            }

            if (!empty($request->date_to)) {
                $where[] = ['created', '<=', $request->date_to];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['unionId'] = $unionId;
        $data['results'] = Member::where($where)->get();
        
        return view('reports.union_report', $data);
    }

    /**
     * Member Report
     */
    public function member(Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'memberReport';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $unionId = '';
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $unionId = $userInfo->union_id;
                $where[] =  ['union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'householder')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }
            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }
            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }
            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
                $unionId = $request->union_id;
            }
            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }
            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            if (!empty($request->date_from)) {
                $where[] = ['created', '>=', $request->date_from];
            }
            if (!empty($request->date_to)) {
                $where[] = ['created', '<=', $request->date_to];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['unionId'] = $unionId;
        $data['results'] = Member::where($where)->get();
        
        return view('reports.member', $data);
    }

    /**
     * Bazar Member Report
     */
    public function bazar_member(Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'bazar_memberReport';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $unionId = '';
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $unionId = $userInfo->union_id;
                $where[] =  ['union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = BazarMember::select('id', 'holder_name', 'mobile_no', 'business_name', 'holding_no')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }
            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }
            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }
            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
                $unionId = $request->union_id;
            }
            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }
            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            if (!empty($request->date_from)) {
                $where[] = ['created', '>=', $request->date_from];
            }
            if (!empty($request->date_to)) {
                $where[] = ['created', '<=', $request->date_to];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['unionId'] = $unionId;
        $data['results'] = BazarMember::where($where)->get();
        
        return view('reports.bazar_member', $data);
    }

    /**
     * Ward Report
     */
    public function ward(Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'wardReport';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $unionId = '';
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $unionId = $userInfo->union_id;
                $where[] =  ['union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'householder')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }
            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }
            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }
            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
                $unionId = $request->union_id;
            }
            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }
            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            if (!empty($request->date_from)) {
                $where[] = ['created', '>=', $request->date_from];
            }
            if (!empty($request->date_to)) {
                $where[] = ['created', '<=', $request->date_to];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['unionId'] = $unionId;
        $data['results'] = Member::where($where)->get();


        return view('reports.ward', $data);
    }
    
    /**
     * Collection Report
     */
    public function collection(Request $request) {
        $data['asideMenu']    = 'report';
        $data['asideSubmenu'] = 'collectionReport';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $unionId = '';
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $unionId = $userInfo->union_id;
                $where[] =  ['union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'householder')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['id', $request->member_id];
            }
            if (!empty($request->holding_no)) {
                $where[] = ['holding_no', $request->holding_no];
            }
            if (!empty($request->district_id)) {
                $where[] = ['district_id', $request->district_id];
            }
            if (!empty($request->upazila_id)) {
                $where[] = ['upazila_id', $request->upazila_id];
            }
            if (!empty($request->union_id)) {
                $where[] = ['union_id', $request->union_id];
                $unionId = $request->union_id;
            }
            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }
            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            if (!empty($request->date_from)) {
                $where[] = ['created', '>=', $request->date_from];
            }
            if (!empty($request->date_to)) {
                $where[] = ['created', '<=', $request->date_to];
            }
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['unionId'] = $unionId;
        $data['results'] = Member::where($where)->get();

        return view('reports.collection', $data);
    }
}