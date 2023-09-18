<?php
namespace App\Http\Controllers;

use App\Models\SignName;
use App\Models\Member;
use App\Models\BanglaNumberToWord;
use App\Models\BazarMember;
use App\Models\TradeLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class TradeLicenseController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * All Notice
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $where = [];


        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allLicense'] = TradeLicense::select('id','license_no','license_owner')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->license_no)) {
                $where[] = ['license_no', $request->license_no];
            }

            if (!empty($request->mobile)) {
                $where[] = ['mobile', $request->mobile];
            }

            if (!empty($request->date_from)) {
                $where[] = ['created','>=', $request->date_from];
            }

            if (!empty($request->date_to)) {
                $where[] = ['created','<=', $request->date_to];
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
        } else{
            $where[] = ['created', date('Y-m-d')];
        }

        $data['results'] = TradeLicense::where($where)->get();

        return view('trade_license.index', $data);
    }

    /**
     * Create Notice
     */
    public function create() {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'add_trade';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $allData = TradeLicense::select('id')->where('union_id', $userInfo->union_id)->get();
        $data['get_id'] = $allData->count();

        return view('trade_license.create', $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {
        $trade = [];

        $data = New TradeLicense();

        $data->created              = numberFilter($request->created,'en');
        $data->district_id          = $request->district_id;
        $data->upazila_id           = $request->upazila_id;
        $data->union_id             = $request->union_id;
        $data->license_no           = numberFilter($request->license_no,'en');
        $data->finance_year         = numberFilter($request->finance_year,'en');
        $data->validity_period      = numberFilter($request->validity_period,'en');
        $data->business_name        = $request->business_name;
        $data->license_owner        = $request->license_owner;
        $data->father_name          = $request->father_name;
        $data->mother_name          = $request->mother_name;
        $data->spouse_name          = $request->spouse_name;
        $data->business_nature      = $request->business_nature;
        $data->business_type        = $request->business_type;
        $data->business_address     = $request->business_address;
        $data->zone                 = $request->zone;
        
        if(!empty($request->business_name_en)){
            $data->business_name_en = $request->business_name_en;
        }
        if(!empty($request->license_owner_en)){
            $data->license_owner_en = $request->license_owner_en;
        }
        if(!empty($request->father_name_en)){
            $data->father_name_en = $request->father_name_en;
        }
        if(!empty($request->mother_name_en)){
            $data->mother_name_en = $request->mother_name_en;
        }
        if(!empty($request->spouse_name_en)){
            $data->spouse_name_en = $request->spouse_name_en;
        }
        if(!empty($request->business_nature_en)){
            $data->business_nature_en = $request->business_nature_en;
        }
        if(!empty($request->business_type_en)){
            $data->business_type_en = $request->business_type_en;
        }
        if(!empty($request->business_address_en)){
            $data->business_address_en = $request->business_address_en;
        }
        if(!empty($request->business_start)){
            $data->business_start = $request->business_start;
        }
        if(!empty($request->zone_en)){
            $data->zone_en = $request->zone_en;
        }
        if(!empty($request->pre_district_id)){
            $data->pre_district_id = $request->pre_district_id;
        }
        if(!empty($request->pre_upazila_id)){
            $data->pre_upazila_id = $request->pre_upazila_id;
        }
        if(!empty($request->pre_union_id)){
            $data->pre_union_id = $request->pre_union_id;
        }
        if(!empty($request->pre_ward_id)){
            $data->pre_ward_id = $request->pre_ward_id;
        }
        if(!empty($request->pre_holding_no)){
            $data->pre_holding_no = $request->pre_holding_no;
        }
        if(!empty($request->pre_road_no)){
            $data->pre_road_no = $request->pre_road_no;
        }
        if(!empty($request->pre_village)){
            $data->pre_village = $request->pre_village;
        }
        if(!empty($request->pre_post_office)){
            $data->pre_post_office = $request->pre_post_office;
        }
        if(!empty($request->pre_post_code)){
            $data->pre_post_code = $request->pre_post_code;
        }
        if(!empty($request->par_district_id)){
            $data->par_district_id = $request->par_district_id;
        }
        if(!empty($request->par_upazila_id)){
            $data->par_upazila_id = $request->par_upazila_id;
        }
        if(!empty($request->par_union_id)){
            $data->par_union_id = $request->par_union_id;
        }
        if(!empty($request->par_ward_id)){
            $data->par_ward_id = $request->par_ward_id;
        }
        if(!empty($request->par_holding_no)){
            $data->par_holding_no = $request->par_holding_no;
        }
        if(!empty($request->par_road_no)){
            $data->par_road_no = $request->par_road_no;
        }
        if(!empty($request->par_village)){
            $data->par_village = $request->par_village;
        }
        if(!empty($request->par_post_office)){
            $data->par_post_office = $request->par_post_office;
        }
        if(!empty($request->par_post_code)){
            $data->par_post_code = $request->par_post_code;
        }
        if(!empty($request->pre_holding_no_en)){
            $data->pre_holding_no_en = $request->pre_holding_no_en;
        }
        if(!empty($request->pre_road_no_en)){
            $data->pre_road_no_en = $request->pre_road_no_en;
        }
        if(!empty($request->pre_village_en)){
            $data->pre_village_en = $request->pre_village_en;
        }
        if(!empty($request->pre_post_office_en)){
            $data->pre_post_office_en = $request->pre_post_office_en;
        }
        if(!empty($request->pre_post_code_en)){
            $data->pre_post_code_en = $request->pre_post_code_en;
        }
        if(!empty($request->par_holding_no_en)){
            $data->par_holding_no_en = $request->par_holding_no_en;
        }
        if(!empty($request->par_road_no_en)){
            $data->par_road_no_en = $request->par_road_no_en;
        }
        if(!empty($request->par_village_en)){
            $data->par_village_en = $request->par_village_en;
        }
        if(!empty($request->par_post_office_en)){
            $data->par_post_office_en = $request->par_post_office_en;
        }
        if(!empty($request->par_post_code_en)){
            $data->par_post_code_en     = $request->par_post_code_en;
        }
        
        $data->email                = $request->email;
        $data->nid                  = numberFilter($request->nid,'en');
        $data->tin                  = numberFilter($request->tin,'en');
        $data->bin                  = numberFilter($request->bin,'en');
        $data->mobile               = numberFilter($request->mobile,'en');
        $data->tax_serial_no        = numberFilter($request->tax_serial_no,'en');
        $data->license_fee          = numberFilter($request->license_fee,'en');
        $data->due_year             = numberFilter($request->due_year,'en');
        $data->due_charge           = numberFilter($request->due_charge,'en');
        $data->sur_charge           = numberFilter($request->sur_charge,'en');
        $data->amendment_charge     = numberFilter($request->amendment_charge,'en');
        $data->signboard_charge     = numberFilter($request->signboard_charge,'en');
        $data->income_tax           = numberFilter($request->income_tax,'en');
        $data->vat                  = numberFilter($request->vat,'en');
        $data->tax_2                = numberFilter($request->tax_2,'en');
        $data->total                = numberFilter($request->total,'en');

        if (!empty($request->file('profile'))) {
            $data->path = uploadFile($request->file('profile'), 'public/uploads/trade_license');
        }

        $data->save();

        if($request->bazar_member == 'yes') {
            $dataBazar = BazarMember::find($request->bazar_id);

            $dataBazar->license_no      = numberFilter($request->license_no,'en');
            $dataBazar->bazar_license   = $request->bazar_member;

            $dataBazar->save();
        }

        $message = ['success' => 'Trade License update successful.'];

        return redirect()->route('admin.trade_license.view',$data->id)->with($message);
    }

    /**
     * View member
     */
    public function view($id) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';

        $data['privilege'] = Auth::user()->privilege;

        $data['obj'] = new BanglaNumberToWord();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();

        $data['info'] = TradeLicense::find($id);

        return view('trade_license.view', $data);
    }
    /**
     * View member
     */
    public function viewEn($id) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';

        $data['privilege'] = Auth::user()->privilege;

        $data['obj'] = new BanglaNumberToWord();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();

        $data['info'] = TradeLicense::find($id);

        return view('trade_license.view_en', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'trade_license';
        $data['asideSubmenu'] = 'all_trade';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $allData = TradeLicense::select('id')->where('union_id', $userInfo->union_id)->get();
        $data['get_id'] = $allData->count();

        $data['privilege'] = Auth::user()->privilege;

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['members.union_id', $userInfo->union_id];
            }
        }
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        //$data['info'] = Notice::find($id);

        $data['info'] = $info = TradeLicense::with('memberInfo')->find($id);

        return view('trade_license.edit', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = TradeLicense::find($request->id);

        $data->created              = numberFilter($request->created,'en');
        $data->district_id          = $request->district_id;
        $data->upazila_id           = $request->upazila_id;
        $data->union_id             = $request->union_id;
        $data->license_no           = numberFilter($request->license_no,'en');
        $data->finance_year         = numberFilter($request->finance_year,'en');
        $data->validity_period      = numberFilter($request->validity_period,'en');
        $data->business_name        = $request->business_name;
        $data->license_owner        = $request->license_owner;
        $data->father_name          = $request->father_name;
        $data->mother_name          = $request->mother_name;
        $data->spouse_name          = $request->spouse_name;
        $data->business_nature      = $request->business_nature;
        $data->business_type        = $request->business_type;
        $data->business_address     = $request->business_address;
        $data->zone                 = $request->zone;
        
        if(!empty($request->business_name_en)){
            $data->business_name_en = $request->business_name_en;
        }
        if(!empty($request->license_owner_en)){
            $data->license_owner_en = $request->license_owner_en;
        }
        if(!empty($request->father_name_en)){
            $data->father_name_en = $request->father_name_en;
        }
        if(!empty($request->mother_name_en)){
            $data->mother_name_en = $request->mother_name_en;
        }
        if(!empty($request->spouse_name_en)){
            $data->spouse_name_en = $request->spouse_name_en;
        }
        if(!empty($request->business_nature_en)){
            $data->business_nature_en = $request->business_nature_en;
        }
        if(!empty($request->business_type_en)){
            $data->business_type_en = $request->business_type_en;
        }
        if(!empty($request->business_address_en)){
            $data->business_address_en = $request->business_address_en;
        }
        if(!empty($request->business_start)){
            $data->business_start = $request->business_start;
        }
        if(!empty($request->zone_en)){
            $data->zone_en = $request->zone_en;
        }
        if(!empty($request->pre_district_id)){
            $data->pre_district_id = $request->pre_district_id;
        }
        if(!empty($request->pre_upazila_id)){
            $data->pre_upazila_id = $request->pre_upazila_id;
        }
        if(!empty($request->pre_union_id)){
            $data->pre_union_id = $request->pre_union_id;
        }
        if(!empty($request->pre_ward_id)){
            $data->pre_ward_id = $request->pre_ward_id;
        }
        if(!empty($request->pre_holding_no)){
            $data->pre_holding_no = $request->pre_holding_no;
        }
        if(!empty($request->pre_road_no)){
            $data->pre_road_no = $request->pre_road_no;
        }
        if(!empty($request->pre_village)){
            $data->pre_village = $request->pre_village;
        }
        if(!empty($request->pre_post_office)){
            $data->pre_post_office = $request->pre_post_office;
        }
        if(!empty($request->pre_post_code)){
            $data->pre_post_code = $request->pre_post_code;
        }
        if(!empty($request->par_district_id)){
            $data->par_district_id = $request->par_district_id;
        }
        if(!empty($request->par_upazila_id)){
            $data->par_upazila_id = $request->par_upazila_id;
        }
        if(!empty($request->par_union_id)){
            $data->par_union_id = $request->par_union_id;
        }
        if(!empty($request->par_ward_id)){
            $data->par_ward_id = $request->par_ward_id;
        }
        if(!empty($request->par_holding_no)){
            $data->par_holding_no = $request->par_holding_no;
        }
        if(!empty($request->par_road_no)){
            $data->par_road_no = $request->par_road_no;
        }
        if(!empty($request->par_village)){
            $data->par_village = $request->par_village;
        }
        if(!empty($request->par_post_office)){
            $data->par_post_office = $request->par_post_office;
        }
        if(!empty($request->par_post_code)){
            $data->par_post_code = $request->par_post_code;
        }
        if(!empty($request->pre_holding_no_en)){
            $data->pre_holding_no_en = $request->pre_holding_no_en;
        }
        if(!empty($request->pre_road_no_en)){
            $data->pre_road_no_en = $request->pre_road_no_en;
        }
        if(!empty($request->pre_village_en)){
            $data->pre_village_en = $request->pre_village_en;
        }
        if(!empty($request->pre_post_office_en)){
            $data->pre_post_office_en = $request->pre_post_office_en;
        }
        if(!empty($request->pre_post_code_en)){
            $data->pre_post_code_en = $request->pre_post_code_en;
        }
        if(!empty($request->par_holding_no_en)){
            $data->par_holding_no_en = $request->par_holding_no_en;
        }
        if(!empty($request->par_road_no_en)){
            $data->par_road_no_en = $request->par_road_no_en;
        }
        if(!empty($request->par_village_en)){
            $data->par_village_en = $request->par_village_en;
        }
        if(!empty($request->par_post_office_en)){
            $data->par_post_office_en = $request->par_post_office_en;
        }
        if(!empty($request->par_post_code_en)){
            $data->par_post_code_en     = $request->par_post_code_en;
        }
        
        $data->email                = $request->email;
        $data->nid                  = numberFilter($request->nid,'en');
        $data->tin                  = numberFilter($request->tin,'en');
        $data->bin                  = numberFilter($request->bin,'en');
        $data->mobile               = numberFilter($request->mobile,'en');
        $data->tax_serial_no        = numberFilter($request->tax_serial_no,'en');
        $data->license_fee          = numberFilter($request->license_fee,'en');
        $data->due_year             = numberFilter($request->due_year,'en');
        $data->due_charge           = numberFilter($request->due_charge,'en');
        $data->sur_charge           = numberFilter($request->sur_charge,'en');
        $data->amendment_charge     = numberFilter($request->amendment_charge,'en');
        $data->signboard_charge     = numberFilter($request->signboard_charge,'en');
        $data->income_tax           = numberFilter($request->income_tax,'en');
        $data->vat                  = numberFilter($request->vat,'en');
        $data->tax_2                = numberFilter($request->tax_2,'en');
        $data->total                = numberFilter($request->total,'en');

        if (!empty($request->file('profile'))) {
            if (file_exists($data->path)) unlink($data->path);
            $data->path = uploadFile($request->file('profile'), 'public/uploads/trade_license');
        }

        $data->save();

        $message = ['update' => 'Trade License update successful.'];
        return redirect()->route('admin.trade_license')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        TradeLicense::find($id)->delete();
        return redirect()->route('admin.trade_license')->with(['delete' => 'Trade License successfully deleted.']);
    }

    public function memberInfo(Request $request) {
        if(!empty($request->id)){
            $partyInfo = DB::table('members')->where('id', $request->id)->first();

            $data = [
                'id'                => $partyInfo->id,
                'name'              => $partyInfo->name,
                'father_name'       => $partyInfo->father_name,
                'holding_no'        => $partyInfo->holding_no,
                'mobile_no'         => $partyInfo->mobile_no,
                'ward_id'           => $partyInfo->ward_id,
                'annual_assessment' => $partyInfo->annual_assessment,
                //'previous_paid'   => (!empty($tranInfo) ? $tranInfo : 0),
            ];
             return (object)$data;
        }
    }


    /**
     * get All Member Ward Wise
     */
    public function wardWiseMembers(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';

        if (!empty($request->ward_id)) {
            if(!empty($request->union_id)){
                $results = DB::table('trade_license')->where([['ward_id', $request->ward_id],['union_id', $request->union_id]])->get();
            }else{
                $results = DB::table('trade_license')->where('ward_id', $request->ward_id)->get();
            }
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' . '(' . $row->holding_no . ') ' . $row->name . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '">' . '(' . $row->holding_no . ') ' . $row->name . '</option>';
                    }

                }
            }
        }
        echo $option;
    }

}
