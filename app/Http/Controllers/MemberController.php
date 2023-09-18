<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Affidavit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    /* All member */
    public function index(Request $request) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'allMember';

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $where = [];

        if (!empty($request->wno)){
            $where[] = ['ward_id', strDecode($request->wno)];
        }

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
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
            }

            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }

            if (!empty($request->mobile_no)) {
                $where[] = ['mobile_no', $request->mobile_no];
            }
            
        } else {
            $where[] = ['created', date('Y-m-d')];
        }

        $data['results'] = Member::where($where)->orderByRaw("CAST(holding_no as unsigned)")->get();
        return view('member.index', $data);
    }

    /**
     * Create member
     */
    public function create() {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'addMember';

        // get user data
        $data['userInfo'] = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        return view('member.create', $data);
    }
    /**
     * Store member
     */
    public function store(Request $request) {
        $data = new Member();

        $existsHoldingNo = Member::where('holding_no', $request->holding_no)->where('ward_id',$request->ward_id)->where('union_id', $request->union_id)->exists();

        if($existsHoldingNo == 0) {
            $data->created      = date('Y-m-d');
            $data->division_id  = $request->division_id;
            $data->district_id  = $request->district_id;
            $data->upazila_id   = $request->upazila_id;
            $data->union_id     = $request->union_id;
            $data->ward_id      = $request->ward_id;
            $data->holding_no   = $request->holding_no;

            $data->village             = $request->village;
            $data->name                = $request->householder;
            $data->householder         = $request->householder;
            $data->householder_wife    = $request->householder_wife;
            $data->father_name         = $request->father_name;
            $data->mother_name         = $request->mother_name;
            $data->religion            = $request->religion;
            $data->profession          = $request->profession;
            $data->gender              = $request->gender;
            $data->settlement_type     = $request->settlement_type;
            $data->ownership_type      = $request->ownership_type;
            $data->handicapped         = $request->handicapped;
            $data->handicapped_name    = $request->handicapped_name;
            $data->social_security_act = $request->social_security_act;
            $data->social_act_name     = $request->social_act_name;
            $data->freedom_fighters    = $request->freedom_fighters;
            $data->fighter_name        = $request->fighter_name;
            $data->fighter_reletion    = $request->fighter_reletion;
            $data->poverty_line        = $request->poverty_line;

            // $data->village_en               = $request->village_en;
            // $data->householder_en           = $request->householder_en;
            // $data->householder_wife_en      = $request->householder_wife_en;
            // $data->father_name_en           = $request->father_name_en;
            // $data->mother_name_en           = $request->mother_name_en;
            // $data->religion_en              = $request->religion_en;
            // $data->profession_en            = $request->profession_en;
            // $data->gender_en                = $request->gender_en;
            // $data->settlement_type_en       = $request->settlement_type_en;
            // $data->ownership_type_en        = $request->ownership_type_en;
            // $data->handicapped_en           = $request->handicapped_en;
            // $data->handicapped_name_en      = $request->handicapped_name_en;
            // $data->social_security_act_en   = $request->social_security_act_en;
            // $data->social_act_name_en       = $request->social_act_name_en;
            // $data->freedom_fighters_en      = $request->freedom_fighters_en;
            // $data->fighter_name_en          = $request->fighter_name_en;
            // $data->fighter_reletion_en      = $request->fighter_reletion_en;
            // $data->poverty_line_en          = $request->poverty_line_en;

            $data->nid_no             = $request->nid_no;
            $data->mobile_no          = numberFilter($request->mobile_no);
            $data->member_male        = numberFilter($request->member_male);
            $data->member_female      = numberFilter($request->member_female);
            $data->floor_size         = $request->floor_size;
            $data->cultivable_land    = $request->cultivable_land;
            $data->uncultivated_land  = $request->uncultivated_land;
            $data->tubewell           = $request->tubewell;
            $data->latrine            = $request->latrine;

            /*$data->bazar            = $request->bazar;
            $data->business_assets    = $request->business_assets;
            $data->trade_license_no   = $request->trade_license_no;*/

            $data->annual_income      = numberFilter($request->annual_income);
            $data->estimated_value    = numberFilter($request->estimated_value);
            $data->annual_assessment  = numberFilter($request->annual_assessment);
            $data->taxes              = numberFilter($request->taxes);

            if (!empty($request->file('member_image'))) {
                $data->path = uploadFile($request->file('member_image'), 'public/uploads/member-image');
            }

            $data->save();

            $message = ['success' => 'Member update successful.'];
        }else {
            $message = ['warning' => 'Holding No Must be Uniqe.'];
        }

        return redirect()->route('admin.member.create')->with($message);
    }

    /*
    * View member
    */
    public function view($id) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'allMember';

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = Member::find($id);

        return view('member.view', $data);
    }

    /*
    * View member English
    */
    public function viewEn($id) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'allMember';

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = Member::find($id);

        return view('member.view_en', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'allMember';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = Member::find($id);

        return view('member.edit', $data);
    }

    /**
     * Edit member
     */
    public function report($id) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'allMember';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $where = [];

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $year = (date('Y') - 1) .'-'. date('Y');

        $memberTranInfo  = DB::table('tax_collections')->where('member_id', $id)->where('year', '!=', $year)->groupBy('year')->orderBy('year', 'asc')->first();
        $data['startYear'] = (!empty($memberTranInfo) ? $memberTranInfo->year : '');

        $memberTranInfo  = DB::table('tax_collections')->where('member_id', $id)->where('year', '!=', $year)->groupBy('year')->orderBy('year', 'desc')->first();
        $data['endYear'] = (!empty($memberTranInfo) ? $memberTranInfo->year : '');

        $memberTaxes  = DB::select("SELECT IFNULL(taxes, 0) AS taxes, year FROM `tax_collections` WHERE member_id='$id' AND deleted_at IS NULL GROUP BY year");

        $totalYear = 0;
        $pTaxes = $cTaxes = 0;
        if(!empty($memberTaxes)){
            foreach($memberTaxes as $key => $row){
                if($row->year == $year){
                    $cTaxes += $row->taxes;
                }else{
                    $pTaxes += $row->taxes;
                    $totalYear++;
                }
            }
        }

        $data['totalYear'] = $totalYear;

        $memberTran = DB::select("SELECT IFNULL(SUM(paid), 0) AS paid, IFNULL(SUM(fine), 0) AS fine, year, receipt_no FROM `tax_collections` WHERE member_id='$id' AND deleted_at IS NULL GROUP BY year");

        $pPaid = $pFine = $cPaid = $cFine = 0;
        if(!empty($memberTran)){
            foreach($memberTran as $key => $row){
                if(!empty($row->receipt_no)) {
                    if($row->year == $year){
                        $cPaid += $row->paid;
                        $cFine += $row->fine;
                        $receiptNo = $row->receipt_no;
                    }else{
                        $pPaid += $row->paid;
                        $pFine += $row->fine;
                        $receiptNo = $row->receipt_no;
                    }
                }
            }
        }

        $data['pInfo'] = $pInfo = (object)[
            'taxes'      => (!empty($pTaxes) ? $pTaxes : ""),
            'paid'       => (!empty($pPaid) ? $pPaid : ""),
            'fine'       => (!empty($pFine) ? $pFine : ""),
            'receipt_no' => (!empty($receiptNo) ? $receiptNo : "")
        ];

        $data['cInfo'] = $cInfo = (object)[
            'year'       => (!empty($year) ? $year : ""),
            'taxes'      => (!empty($cTaxes) ? $cTaxes : ""),
            'paid'       => (!empty($cPaid) ? $cPaid : ""),
            'fine'       => (!empty($cFine) ? $cFine : ""),
        ];

        $texes = $pInfo->taxes + $cInfo->taxes;
        $paid  = $pInfo->paid + $cInfo->paid;
        $fine  = $pInfo->fine + $cInfo->fine;

        $data['tInfo'] = (object)[
            'taxes' => $texes,
            'paid'  => $paid,
            'due'   => $texes - $paid,
            'fine'  => $fine,
        ];

        return view('member.report', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = Member::find($request->id);

        $data->division_id      = $request->division_id;
        $data->district_id      = $request->district_id;
        $data->upazila_id       = $request->upazila_id;
        $data->union_id         = $request->union_id;
        $data->ward_id          = $request->ward_id;
        $data->holding_no       = $request->holding_no;

        $data->village              = $request->village;
        $data->name                 = $request->householder;
        $data->householder          = $request->householder;
        $data->householder_wife     = $request->householder_wife;
        $data->father_name          = $request->father_name;
        $data->mother_name          = $request->mother_name;
        $data->religion             = $request->religion;
        $data->profession           = $request->profession;
        $data->gender               = $request->gender;
        $data->settlement_type      = $request->settlement_type;
        $data->ownership_type       = $request->ownership_type;
        $data->handicapped          = $request->handicapped;
        $data->handicapped_name     = $request->handicapped_name;
        $data->social_security_act  = $request->social_security_act;
        $data->social_act_name      = $request->social_act_name;
        $data->freedom_fighters     = $request->freedom_fighters;
        $data->fighter_name         = $request->fighter_name;
        $data->fighter_reletion     = $request->fighter_reletion;
        $data->poverty_line         = $request->poverty_line;

        // $data->village_en               = $request->village_en;
        // $data->householder_en           = $request->householder_en;
        // $data->householder_wife_en      = $request->householder_wife_en;
        // $data->father_name_en           = $request->father_name_en;
        // $data->mother_name_en           = $request->mother_name_en;
        // $data->religion_en              = $request->religion_en;
        // $data->profession_en            = $request->profession_en;
        // $data->gender_en                = $request->gender_en;
        // $data->settlement_type_en       = $request->settlement_type_en;
        // $data->ownership_type_en        = $request->ownership_type_en;
        // $data->handicapped_en           = $request->handicapped_en;
        // $data->handicapped_name_en      = $request->handicapped_name_en;
        // $data->social_security_act_en   = $request->social_security_act_en;
        // $data->social_act_name_en       = $request->social_act_name_en;
        // $data->freedom_fighters_en      = $request->freedom_fighters_en;
        // $data->fighter_name_en          = $request->fighter_name_en;
        // $data->fighter_reletion_en      = $request->fighter_reletion_en;
        // $data->poverty_line_en          = $request->poverty_line_en;

        $data->nid_no               = $request->nid_no;
        $data->mobile_no            = numberFilter($request->mobile_no);
        $data->member_male          = numberFilter($request->member_male);
        $data->member_female        = numberFilter($request->member_female);
        $data->floor_size           = $request->floor_size;
        $data->cultivable_land      = $request->cultivable_land;
        $data->uncultivated_land    = $request->uncultivated_land;
        $data->tubewell             = $request->tubewell;
        $data->latrine              = $request->latrine;

        /*$data->bazar              = $request->bazar;
        $data->business_assets      = $request->business_assets;
        $data->trade_license_no     = $request->trade_license_no;*/

        $data->annual_income        = numberFilter($request->annual_income);
        $data->estimated_value      = numberFilter($request->estimated_value);
        $data->annual_assessment    = numberFilter($request->annual_assessment);
        $data->taxes                = numberFilter($request->taxes);

        if (!empty($request->file('member_image'))) {
            if (file_exists($data->path)) unlink($data->path);
            $data->path = uploadFile($request->file('member_image'), 'public/uploads/member-image');
        }

        $data->save();

        $message = ['update' => 'Member update successful.'];

        return redirect()->route('admin.member')->with($message);
    }
    /*
    * Create member Affidavit
    */
    public function Affidavit($id) {
        $data['asideMenu']    = 'member';
        $data['asideSubmenu'] = 'addMember';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();
        
        $data['memberInfo'] = Member::find($id);
        
        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','citizenship_certificate']])->get();
        $data['get_id'] = $allData->count();


        return view('member.affidavit', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Member::find($id)->delete();

        return redirect()->route('admin.member')->with(['delete' => 'Member successfully deleted.']);
    }

    /**
     * get district list
     */
    public function districtList(Request $request) {
        $option = '<option value="" selected>জেলা নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('districts')->where('division_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /**
     * get Upazila list
     */
    public function upazilaList(Request $request) {
        $option = '<option value="" selected>উপজেলা নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('upazilas')->where('district_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /**
     * get Pourashava list
     */
    public function pourashavaList(Request $request) {
        $option = '<option value="" selected>পৌরসভা নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('pourashava')->where('district_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->name_bn . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->name_bn . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /**
     * get Union list
     */
    public function unionList(Request $request) {
        $option = '<option value="" selected>ইউনিয়ন নির্বাচন করুন</option>';
        if (!empty($request->id)) {
            $results = DB::table('unions')->where('upazilla_id', $request->id)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . $row->bn_name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . $row->bn_name . '</option>';
                    }
                }
            }
        }
        echo $option;
    }

    /*
     * get All Member Ward Wise
     */
    public function wardWiseMembers(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';
        if (!empty($request->ward_id)) {
            if(!empty($request->union_id)){
                $results = DB::table('members')->where([['ward_id', $request->ward_id],['union_id', $request->union_id]])->get();
            }else{
                $results = DB::table('members')->where('ward_id', $request->ward_id)->get();
            }
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . '(' . $row->holding_no . ') ' . $row->name . ' - (' . $row->mobile_no . ') ' . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . '(' . $row->holding_no . ') ' . $row->name . ' - (' . $row->mobile_no . ') ' . '</option>';
                    }

                }
            }
        }
        echo $option;
    }

    public function getHoldingNo(Request $request) {
        if (!empty($request->holding_no)) {

            $partyInfo = DB::table('members')->where('holding_no', $request->holding_no)->where('ward_id', $request->ward_id)->where('union_id', $request->union_id)->first();

            if(!empty($partyInfo)){
                $data = [
                    'id'        => $partyInfo->id,
                    'holding_no'=> $partyInfo->holding_no,
                    'union_id'  => $partyInfo->union_id,
                    'ward_id'   => $partyInfo->ward_id,
                ];
                return (object)$data;
            }else {
                return 'Not Match';
            }
        }
    }

    public function getZillaEn(Request $request) {
        $districtList = [];
        if (!empty($request->select_id)) {
            $districtList = DB::table('districts')->where('id', $request->select_id)->get();
        }else{
            $districtList = DB::table('districts')->where('id', $request->id)->get();
        }
        if(!empty($districtList)){
            echo $districtList[0]->name;
        }
    }

    public function getUpZillaEn(Request $request) {
        $upazilasList = [];
        if (!empty($request->select_id)) {
            $upazilasList = DB::table('upazilas')->where('id', $request->select_id)->get();
        }else {
            $upazilasList = DB::table('upazilas')->where('id', $request->id)->get();
        }
        if(!empty($upazilasList)){
            echo $upazilasList[0]->name;
        }
    }

    public function getPourashavaEn(Request $request) {
        $pourashavaList = [];
        if (!empty($request->select_id)) {
            $pourashavaList = DB::table('pourashava')->where('id', $request->select_id)->get();
        }else {
            $pourashavaList = DB::table('pourashava')->where('id', $request->id)->get();
        }
        if(!empty($pourashavaList)){
            echo $pourashavaList[0]->name;
        }
    }

    public function getUnionEn(Request $request) {
        $unionsList = [];
        if (!empty($request->select_id)) {
            $unionsList = DB::table('unions')->where('id', $request->select_id)->get();
        } else {
            $unionsList = DB::table('unions')->where('id', $request->id)->get();
        }
        if(!empty($unionsList)){
            echo $unionsList[0]->name;
        }
    }

    public function getWardEn(Request $request) {
        $wardsList = [];
        if (!empty($request->select_id)) {
            $wardsList = DB::table('wards')->where('id', $request->select_id)->get();
        } else {
            $wardsList = DB::table('wards')->where('id', $request->id)->get();
        }
        if(!empty($wardsList)){
            echo $wardsList[0]->name_en;
        }
    }

}
