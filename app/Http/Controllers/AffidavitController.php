<?php

namespace App\Http\Controllers;

use App\Models\SignName;
use App\Models\Member;
use App\Models\Affidavit;
use App\Models\Inheritance;
use App\Models\Family;
use App\Models\Inherit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AffidavitController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * All Affidavit
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'allAffidavit';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

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

        $where = [];

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['member_id', $request->member_id];
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

            if (!empty($request->ward_id)) {
                $where[] = ['ward_id', $request->ward_id];
            }

            if(!empty($request->affidavit_type)) {
                $where[] = ['affidavit_type', $request->affidavit_type];
            }
        } else{
            $where[] = ['created', date('Y-m-d')];
        }

        /*$select = [ 'affidavits.*', 'inherits.affidavit_id','inherits.inherit_name','inherits.inherit_dob','inherits.inherit_year',
                    'inherits.inherit_relation','inherits.inherit_remarks'];

        $data['results'] = DB::table('affidavits')->join('inherits', 'affidavits.id', '=', 'inherits.affidavit_id')->select($select)->where($where)->get();*/

        $data['results'] = Affidavit::where($where)->get();

        $data['inherit'] = Inherit::get();

        return view('affidavit.index', $data);
    }

    /**
    * Create Affidavit
    */

    public function create() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'addAffidavit';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();


        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','citizenship_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.create', $data);
    }
    /**
    * Inheritance Certificate Affidavit
    */

    public function inheritance() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'inheritanceCertificate';

        $data['inheritData'] = Inheritance::all();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','inheritance_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.inheritance', $data);
    }
    /**
    * Family Certificate Affidavit
    */

    public function family() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'familyCertificate';

        $data['familyData'] = Family::where('id',1)->get();

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','family_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.family', $data);
    }

    /**
    * New  Affidavit Certificate
    */

    public function new_affidavit() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'newAffidavit';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','new_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.new_affidavit', $data);
    }

    /**
    * Unmarried Affidavit
    */
    public function unmarried() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'unmarriedCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','unmarried_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.unmarried', $data);
    }

    /**
    * Married Affidavit
    */
    public function married() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'marriedCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','married_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.married', $data);
    }

    /**
    * Married Affidavit
    */
    public function income() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'incomeCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','income_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.income', $data);
    }

    /**
    * Carecture Affidavit
    */
    public function carecture() {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'carectureCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $data['privilege'] = Auth::user()->privilege;

        $data['wards']  = DB::table('wards')->get();

        $allData = Affidavit::select('id')->where([['union_id', $userInfo->union_id],['affidavit_type','carecture_certificate']])->get();
        $data['get_id'] = $allData->count();

        return view('affidavit.carecture', $data);
    }


    /**
    * Store Affidavit
    */

    public function store(Request $request) {
        $data  = New Affidavit();

        if (!empty($request->created)) {
            $data->created = $request->created;
        } else {
            $data->created = date('Y-m-d');
        }
        
        if(!empty($request->affidavit_no)){
            $data->affidavit_no = numberFilter($request->affidavit_no);
        }
        
        if(!empty($request->member_name)){
            $data->member_name = $request->member_name;
        }
        
        if(!empty($request->father_name)){
            $data->father_name = $request->father_name;
        }
        
        if(!empty($request->mother_name)){
            $data->mother_name = $request->mother_name;
        }
        
        if(!empty($request->district_id)){
            $data->district_id = $request->district_id;
        }
        
        if(!empty($request->upazila_id)){
            $data->upazila_id = $request->upazila_id;
        }
        
        if (!empty($request->pourashava_id)) {
            $data->pourashava_id = $request->pourashava_id;
        }
        
        if(!empty($request->union_id)){
            $data->union_id = $request->union_id;
        }
        
        if(!empty($request->ward_id)){
            $data->ward_id = $request->ward_id;
        }
        
        if(!empty($request->holding_no)){
            $data->holding_no = numberFilter($request->holding_no);
        }
        
        if(!empty($request->post_office)){
            $data->post_office = $request->post_office;
        }
        
        if (!empty($request->post_code)) {
            $data->post_code = $request->post_code;
        }
        
        if(!empty($request->village)){
            $data->village = $request->village;
        }
        
        if(!empty($request->member_name_en)){
            $data->member_name_en = $request->member_name_en;
        }
        
        if(!empty($request->father_name_en)){
            $data->father_name_en = $request->father_name_en;
        }
        
        if(!empty($request->mother_name_en)){
            $data->mother_name_en = $request->mother_name_en;
        }
        
        if(!empty($request->post_office_en)){
            $data->post_office_en = $request->post_office_en;
        }
        
        if(!empty($request->village_en)){
            $data->village_en = $request->village_en;
        }
        
        if(!empty($request->nid_no)){
            $data->nid = numberFilter($request->nid_no);
        }
        
        if(!empty($request->mobile_no)){
            $data->mobile = numberFilter($request->mobile_no);
        }
        
        if (!empty($request->affidavit_type)) {
            $data->affidavit_type  = $request->affidavit_type;
        }
        
        if (!empty($request->file('affidavit_image'))) {
            $data->path = uploadFile($request->file('affidavit_image'), 'public/uploads/affidavit');
        }

        /* Store Affidavit Certificate function */
        if($request->affidavit_type == "affidavit_certificate"){
            
            if(!empty($request->marital_status)){
                $data->marital_status = $request->marital_status;
            }
            
            if(!empty($request->religion)){
                $data->religion = $request->religion;
            }
        }

        /* Store Citizenship Certificate function */
        if($request->affidavit_type == "citizenship_certificate"){
            if(!empty($request->memorial_no)) {
                $data->memorial_no = numberFilter($request->memorial_no);
            }
        }

        /* Store Affidavit Inheritance & Family Function */
        if($request->affidavit_type == "inheritance_certificate" || $request->affidavit_type == "family_certificate"){
            $data->inherit_id      = $request->id;
            $data->all_data        = $request->all_data;

            // $data2  = New Inheritance();

            // $data2->created = date('Y-m-d');
            // $data2->all_data = $request->all_data;

            // $data2->save();

            /* Store Affidavit Family Function */

            // $data2  = New Family();

            // $data2->created = date('Y-m-d');
            // $data2->all_data = $request->all_data;

            // $data2->save();
        }

        /* Store Affidavit Income Function */
        if($request->affidavit_type == "income_certificate"){
            if(!empty($request->father_profession)){
                $data->father_profession   = $request->father_profession;
            }
            
            if(!empty($request->father_profession_en)){
                $data->father_profession_en= $request->father_profession_en;
            }
            
            if(!empty($request->monthly_income)){
                $data->monthly_income      = $request->monthly_income;
            }
            
            if(!empty($request->yearly_income)){
                $data->yearly_income       = $request->yearly_income;
            }
        }

        /* Store Affidavit Married Function */
        if($request->affidavit_type == "married_certificate"){

            if(!empty($request->dob)) {
                $data->dob = $request->dob;
            }
            
            if(!empty($request->marriage_date)) {
                $data->marriage_date = $request->marriage_date;
            }
            
            if(!empty($request->wife_name)) {
                $data->wife_name = $request->wife_name;
            }
            
            if(!empty($request->wife_father_name)) {
                $data->wife_father_name = $request->wife_father_name;
            }
            
            if(!empty($request->wife_mother_name)) {
                $data->wife_mother_name = $request->wife_mother_name;
            }
            
            if(!empty($request->wife_nid_no)) {
                $data->wife_nid_no = $request->wife_nid_no;
            }
            
            if(!empty($request->wife_dob)) {
                $data->wife_dob = $request->wife_dob;
            }
            
            if(!empty($request->wife_district_id)) {
                $data->wife_district_id = $request->wife_district_id;
            }
            
            if(!empty($request->wife_upazila_id)) {
                $data->wife_upazila_id = $request->wife_upazila_id;
            }
            
            if(!empty($request->wife_union_id)) {
                $data->wife_union_id = $request->wife_union_id;
            }
            
            if(!empty($request->wife_ward_id)) {
                $data->wife_ward_id = $request->wife_ward_id;
            }
            
            if(!empty($request->wife_holding_no)) {
                $data->wife_holding_no = $request->wife_holding_no;
            }
            
            if(!empty($request->wife_post_office)) {
                $data->wife_post_office = $request->wife_post_office;
            }
            
            if(!empty($request->wife_village)) {
                $data->wife_village = $request->wife_village;
            }
            
            if(!empty($request->wife_name_en)) {
                $data->wife_name_en = $request->wife_name_en;
            }
            
            if(!empty($request->wife_father_name_en)) {
                $data->wife_father_name_en = $request->wife_father_name_en;
            }
            
            if(!empty($request->wife_mother_name_en)) {
                $data->wife_mother_name_en = $request->wife_mother_name_en;
            }
            
            if(!empty($request->wife_post_office_en)) {
                $data->wife_post_office_en = $request->wife_post_office_en;
            }
            
            if(!empty($request->wife_village_en)) {
                $data->wife_village_en = $request->wife_village_en;
            }
            
            if(!empty($request->ragi_date)) {
                $data->ragi_date = $request->ragi_date;
            }
            
            if(!empty($request->ragi_serial_no)) {
                $data->ragi_serial_no = $request->ragi_serial_no;
            }
            
            if(!empty($request->ragi_page_no)) {
                $data->ragi_page_no = $request->ragi_page_no;
            }
            
            if(!empty($request->ragi_column_no)) {
                $data->ragi_column_no = $request->ragi_column_no;
            }
            
            if(!empty($request->ragi_year)) {
                $data->ragi_year = $request->ragi_year;
            }
            
            if(!empty($request->regi_address)) {
                $data->regi_address = $request->regi_address;
            }
            
            if(!empty($request->regi_address_en)) {
                $data->regi_address_en = $request->regi_address_en;
            }
        }
        
        if($request->member_affidavit == "member_affidavit"){
            if(!empty($request->member_id)) {
                $data->member_id = $request->member_id;
            }
            
            if($request->affidavit_type == "affidavit_certificate"){
                if(!empty($request->marital_status)) {
                    $data->marital_status = $request->marital_status;
                }
                
                if(!empty($request->religion)){
                    $data->religion = $request->religion;
                }
            }
            
            if($request->affidavit_type == "citizenship_certificate"){
                if(!empty($request->citizen_member_name)){
                    $data->member_name = $request->citizen_member_name;
                }
                
                if(!empty($request->citizen_father_name)){
                    $data->father_name = $request->citizen_father_name;
                }
                
                if(!empty($request->citizen_mother_name)) {
                    $data->mother_name = $request->citizen_mother_name;
                }
                
                if(!empty($request->citizen_district_id)){
                    $data->district_id = $request->citizen_district_id;
                }
                
                if(!empty($request->citizen_upazila_id)){
                    $data->upazila_id = $request->citizen_upazila_id;
                }
                
                if(!empty($request->citizen_union_id)){
                    $data->union_id = $request->citizen_union_id;
                }
                
                if(!empty($request->citizen_ward_id)) {
                    $data->ward_id = $request->citizen_ward_id;
                }
                
                if(!empty($request->citizen_holding_no)) {
                    $data->holding_no = $request->citizen_holding_no;
                }
                
                if(!empty($request->citizen_post_office)) {
                    $data->post_office = $request->citizen_post_office;
                }
                
                if(!empty($request->citizen_village)) {
                    $data->village = $request->citizen_village;
                }
                
                if(!empty($request->citizen_marital_status)) {
                    $data->marital_status = $request->citizen_marital_status;
                }
                
                if(!empty($request->citizen_religion)) {
                    $data->religion = $request->citizen_religion;
                }
                
                if(!empty($request->citizen_member_name_en)) {
                    $data->member_name_en = $request->citizen_member_name_en;
                }
                
                if(!empty($request->citizen_father_name_en)) {
                    $data->father_name_en = $request->citizen_father_name_en;
                }
                
                if(!empty($request->citizen_mother_name_en)) {
                    $data->mother_name_en = $request->citizen_mother_name_en;
                }
                
                if(!empty($request->citizen_post_office_en)) {
                    $data->post_office_en = $request->citizen_post_office_en;
                }
                
                if(!empty($request->citizen_village_en)) {
                    $data->village_en = $request->citizen_village_en;
                }
                
                if(!empty($request->citizen_nid_no)) {
                    $data->nid_no = $request->citizen_nid_no;
                }
                
                if(!empty($request->citizen_mobile_no)) {
                    $data->mobile_no = $request->citizen_mobile_no;
                }
        
                if(!empty($request->file('citizen_member_path'))) {
                    $data->path = uploadFile($request->file('citizen_member_path'), 'public/uploads/affidavit');
                } else {
                    if (!empty($request->file('citizen_member_image'))) {
                        $data->path = uploadFile($request->file('citizen_member_image'), 'public/uploads/affidavit');
                    }
                }
            }
            
            if($request->affidavit_type == "unmarried_certificate"){
                if(!empty($request->unmarried_member_name)) {
                    $data->member_name = $request->unmarried_member_name;
                }
                
                if(!empty($request->unmarried_father_name)) {
                    $data->father_name = $request->unmarried_father_name;
                }
                
                if(!empty($request->unmarried_mother_name)) {
                    $data->mother_name = $request->unmarried_mother_name;
                }
                
                if(!empty($request->unmarried_district_id)){
                    $data->district_id = $request->unmarried_district_id;
                }
                
                if(!empty($request->unmarried_upazila_id)) {
                    $data->upazila_id = $request->unmarried_upazila_id;
                }
                
                if(!empty($request->unmarried_union_id)) {
                    $data->union_id = $request->unmarried_union_id;
                }
                
                if(!empty($request->unmarried_ward_id)) {
                    $data->ward_id = $request->unmarried_ward_id;
                }
                
                if(!empty($request->unmarried_holding_no)){
                    $data->holding_no = $request->unmarried_holding_no;
                }
                
                if(!empty($request->unmarried_post_office)) {
                    $data->post_office = $request->unmarried_post_office;
                }
                
                if(!empty($request->unmarried_village)) {
                    $data->village = $request->unmarried_village;
                }
                
                if(!empty($request->unmarried_marital_status)) {
                    $data->marital_status = $request->unmarried_marital_status;
                }
                
                if(!empty($request->unmarried_religion)) {
                    $data->religion = $request->unmarried_religion;
                }
                
                if(!empty($request->unmarried_member_name_en)) {
                    $data->member_name_en = $request->unmarried_member_name_en;
                }
                
                if(!empty($request->unmarried_father_name_en)) {
                    $data->father_name_en = $request->unmarried_father_name_en;
                }
                
                if(!empty($request->unmarried_mother_name_en)) {
                    $data->mother_name_en = $request->unmarried_mother_name_en;
                }
                
                if(!empty($request->unmarried_post_office_en)) {
                    $data->post_office_en = $request->unmarried_post_office_en;
                }
                
                if(!empty($request->unmarried_village_en)) {
                    $data->village_en = $request->unmarried_village_en;
                }
                
                if(!empty($request->unmarried_nid_no)) {
                    $data->nid_no = $request->unmarried_nid_no;
                }
                
                if(!empty($request->unmarried_mobile_no)) {
                    $data->mobile_no = $request->unmarried_mobile_no;
                }
        
                if(!empty($request->file('unmarried_member_path'))) {
                    $data->path = uploadFile($request->file('unmarried_member_path'), 'public/uploads/affidavit');
                } else {
                    if (!empty($request->file('unmarried_member_image'))) {
                        $data->path = uploadFile($request->file('unmarried_member_image'), 'public/uploads/affidavit');
                    }
                }
        
            }
            
            if($request->affidavit_type == "married_certificate"){
                if(!empty($request->married_member_name)) {
                    $data->member_name = $request->married_member_name;
                }
                
                if(!empty($request->married_father_name)) {
                    $data->father_name = $request->married_father_name;
                }
                
                if(!empty($request->married_mother_name)) {
                    $data->mother_name = $request->married_mother_name;
                }
                
                if(!empty($request->married_nid_no)) {
                    $data->nid_no = $request->married_nid_no;
                }
                
                if(!empty($request->married_dob)) {
                    $data->dob = $request->married_dob;
                }
                
                if(!empty($request->married_district_id)) {
                    $data->district_id = $request->married_district_id;
                }
                
                if(!empty($request->married_upazila_id)) {
                    $data->upazila_id = $request->married_upazila_id;
                }
                
                if(!empty($request->married_union_id)) {
                    $data->union_id = $request->married_union_id;
                }
                
                if(!empty($request->married_ward_id)) {
                    $data->ward_id = $request->married_ward_id;
                }
                
                if(!empty($request->married_holding_no)) {
                    $data->holding_no = $request->married_holding_no;
                }
                
                if(!empty($request->married_post_office)) {
                    $data->post_office = $request->married_post_office;
                }
                
                if(!empty($request->married_village)) {
                    $data->village = $request->married_village;
                }
                
                if(!empty($request->married_member_name_en)) {
                    $data->member_name_en = $request->married_member_name_en;
                }
                
                if(!empty($request->married_father_name_en)) {
                    $data->father_name_en = $request->married_father_name_en;
                }
                
                if(!empty($request->married_mother_name_en)) {
                    $data->mother_name_en = $request->married_mother_name_en;
                }
                
                if(!empty($request->married_post_office_en)) {
                    $data->post_office_en = $request->married_post_office_en;
                }
                
                if(!empty($request->married_village_en)) {
                    $data->village_en = $request->married_village_en;
                }
                
                if(!empty($request->married_wife_name)) {
                    $data->wife_name = $request->married_wife_name;
                }
                
                if(!empty($request->married_wife_father_name)) {
                    $data->wife_father_name = $request->married_wife_father_name;
                }
                
                if(!empty($request->married_wife_mother_name)) {
                    $data->wife_mother_name = $request->married_wife_mother_name;
                }
                
                if(!empty($request->married_wife_nid_no)) {
                    $data->wife_nid_no = $request->married_wife_nid_no;
                }
                
                if(!empty($request->married_wife_dob)) {
                    $data->wife_dob = $request->married_wife_dob;
                }
                
                if(!empty($request->married_wife_district_id)) {
                    $data->wife_district_id = $request->married_wife_district_id;
                }
                
                if(!empty($request->married_wife_upazila_id)) {
                    $data->wife_upazila_id = $request->married_wife_upazila_id;
                }
                
                if(!empty($request->married_wife_union_id)) {
                    $data->wife_union_id = $request->married_wife_union_id;
                }
                
                if(!empty($request->married_wife_ward_id)) {
                    $data->wife_ward_id = $request->married_wife_ward_id;
                }
                
                if(!empty($request->wife_holding_no)) {
                    $data->ding_no = $request->wife_holding_no;
                }
                
                if(!empty($request->married_wife_post_office)) {
                    $data->wife_post_office = $request->married_wife_post_office;
                }
                
                if(!empty($request->married_wife_village)) {
                    $data->wife_village = $request->married_wife_village;
                }
                
                if(!empty($request->married_wife_name_en)) {
                    $data->wife_name_en = $request->married_wife_name_en;
                }
                
                if(!empty($request->married_wife_father_name_en)) {
                    $data->wife_father_name_en = $request->married_wife_father_name_en;
                }
                
                if(!empty($request->married_wife_mother_name_en)) {
                    $data->wife_mother_name_en = $request->married_wife_mother_name_en;
                }
                
                if(!empty($request->married_wife_post_office_en)) {
                    $data->wife_post_office_en = $request->married_wife_post_office_en;
                }
                
                if(!empty($request->married_wife_village_en)) {
                    $data->wife_village_en = $request->married_wife_village_en;
                }
                
                if(!empty($request->married_ragi_date)) {
                    $data->ragi_date = $request->married_ragi_date;
                }
                
                if(!empty($request->married_ragi_serial_no)) {
                    $data->ragi_serial_no = $request->married_ragi_serial_no;
                }
                
                if(!empty($request->married_ragi_page_no)) {
                    $data->ragi_page_no = $request->married_ragi_page_no;
                }
                
                if(!empty($request->married_ragi_column_no)) {
                    $data->ragi_column_no = $request->married_ragi_column_no;
                }
                
                if(!empty($request->married_ragi_year)) {
                    $data->ragi_year = $request->married_ragi_year;
                }
                
                if(!empty($request->married_regi_address)) {
                    $data->regi_address = $request->married_regi_address;
                }
                
                if(!empty($request->married_regi_address_en)) {
                    $data->regi_address_en = $request->married_regi_address_en;
                }
            }
            
            if($request->affidavit_type == "income_certificate"){
                if(!empty($request->income_member_name)) {
                    $data->member_name = $request->income_member_name;
                }
                
                if(!empty($request->income_father_name)) {
                    $data->father_name = $request->income_father_name;
                }
                
                if(!empty($request->income_mother_name)) {
                    $data->mother_name = $request->income_mother_name;
                }
                
                if(!empty($request->income_district_id)) {
                    $data->district_id = $request->income_district_id;
                }
                
                if(!empty($request->income_upazila_id)) {
                    $data->upazila_id = $request->income_upazila_id;
                }
                
                if(!empty($request->income_union_id)) {
                    $data->union_id = $request->income_union_id;
                }
                
                if(!empty($request->income_ward_id)) {
                    $data->ward_id = $request->income_ward_id;
                }
                
                if(!empty($request->income_holding_no)) {
                    $data->holding_no = $request->income_holding_no;
                }
                
                if(!empty($request->income_post_office)) {
                    $data->post_office = $request->income_post_office;
                }
                
                if(!empty($request->income_village)) {
                    $data->village = $request->income_village;
                }
                
                if(!empty($request->income_marital_status)) {
                    $data->marital_status = $request->income_marital_status;
                }
                
                if(!empty($request->income_religion)) {
                    $data->religion = $request->income_religion;
                }
                
                if(!empty($request->income_member_name_en)) {
                    $data->member_name_en = $request->income_member_name_en;
                }
                
                if(!empty($request->income_father_name_en)) {
                    $data->father_name_en = $request->income_father_name_en;
                }
                
                if(!empty($request->income_mother_name_en)) {
                    $data->mother_name_en = $request->income_mother_name_en;
                }
                
                if(!empty($request->income_post_office_en)) {
                    $data->post_office_en = $request->income_post_office_en;
                }
                
                if(!empty($request->income_village_en)) {
                    $data->village_en = $request->income_village_en;
                }
                
                if(!empty($request->income_nid_no)) {
                    $data->nid_no = $request->income_nid_no;
                }
                
                if(!empty($request->income_mobile_no)) {
                    $data->mobile_no = $request->income_mobile_no;
                }
                
                if(!empty($request->income_monthly_income)) {
                    $data->monthly_income = $request->income_monthly_income;
                }
                
                if(!empty($request->income_yearly_income)) {
                    $data->yearly_income = $request->income_yearly_income;
                }
            }
            
            if($request->affidavit_type == "carecture_certificate"){
                if(!empty($request->carecture_member_name)) {
                    $data->member_name = $request->carecture_member_name;
                }
                
                if(!empty($request->carecture_father_name)) {
                    $data->father_name = $request->carecture_father_name;
                }
                
                if(!empty($request->carecture_mother_name)) {
                    $data->mother_name = $request->carecture_mother_name;
                }
                
                if(!empty($request->carecture_district_id)) {
                    $data->district_id = $request->carecture_district_id;
                }
                
                if(!empty($request->carecture_upazila_id)) {
                    $data->upazila_id = $request->carecture_upazila_id;
                }
                
                if(!empty($request->carecture_union_id)) {
                    $data->union_id = $request->carecture_union_id;
                }
                
                if(!empty($request->carecture_ward_id)) {
                    $data->ward_id = $request->carecture_ward_id;
                }
                
                if(!empty($request->carecture_holding_no)) {
                    $data->holding_no = $request->carecture_holding_no;
                }
                
                if(!empty($request->carecture_post_office)) {
                    $data->post_office = $request->carecture_post_office;
                }
                
                if(!empty($request->carecture_village)) {
                    $data->village = $request->carecture_village;
                }
                
                if(!empty($request->carecture_marital_status)) {
                    $data->marital_status = $request->carecture_marital_status;
                }
                
                if(!empty($request->carecture_religion)) {
                    $data->religion = $request->carecture_religion;
                }
                
                if(!empty($request->carecture_member_name_en)) {
                    $data->member_name_en = $request->carecture_member_name_en;
                }
                
                if(!empty($request->carecture_father_name_en)) {
                    $data->father_name_en = $request->carecture_father_name_en;
                }
                
                if(!empty($request->carecture_mother_name_en)) {
                    $data->mother_name_en = $request->carecture_mother_name_en;
                }
                
                if(!empty($request->carecture_post_office_en)) {
                    $data->post_office_en = $request->carecture_post_office_en;
                }
                
                if(!empty($request->carecture_village_en)) {
                    $data->village_en = $request->carecture_village_en;
                }
                
                if(!empty($request->carecture_nid_no)) {
                    $data->nid_no = $request->carecture_nid_no;
                }
                
                if(!empty($request->carecture_mobile_no)) {
                    $data->mobile_no = $request->carecture_mobile_no;
                }
        
                if(!empty($request->file('carecture_member_path'))) {
                    $data->path = uploadFile($request->file('carecture_member_path'), 'public/uploads/affidavit');
                } else {
                    if (!empty($request->file('carecture_member_image'))) {
                        $data->path = uploadFile($request->file('carecture_member_image'), 'public/uploads/affidavit');
                    }
                }
            }
        }

        $data->save();
        $id = $data->id;

        $message = ['success' => 'Affidavit Add successful.'];

        return redirect()->route('admin.affidavit')->with($message);
    }

    /**
    * View Affidavit Inheritance Certificate
    */

    public function view_inheritance($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'inheritanceCertificate';

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();


        $data['info'] = $info = Affidavit::find($id);

        return view('affidavit.view_inheritance', $data);
    }
    /**
    * View Affidavit Inheritance Certificate
    */

    public function viewMarried($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'marriedCertificate';

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();


        $data['info'] = $info = Affidavit::find($id);

        return view('affidavit.view_married', $data);
    }
    /**
    * View Affidavit Inheritance Certificate
    */

    public function viewMarriedEn($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'marriedCertificate';

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();


        $data['info'] = $info = Affidavit::find($id);

        return view('affidavit.view_married_en', $data);
    }

    /**
    * View Affidavit
    */

    public function view($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'allAffidavit';

        $data['divisions']   = DB::table('divisions')->get();
        $data['districts']   = DB::table('districts')->get();
        $data['upazilas']    = DB::table('upazilas')->get();
        $data['pourashavas'] = DB::table('pourashava')->get();
        $data['unions']      = DB::table('unions')->get();
        $data['wards']       = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();

        $data['info'] = Affidavit::find($id);

        return view('affidavit.view', $data);
    }

    /**
    * View Affidavit
    */

    public function viewEn($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'allAffidavit';

        $data['divisions']   = DB::table('divisions')->get();
        $data['districts']   = DB::table('districts')->get();
        $data['upazilas']    = DB::table('upazilas')->get();
        $data['pourashavas'] = DB::table('pourashava')->get();
        $data['unions']      = DB::table('unions')->get();
        $data['wards']       = DB::table('wards')->get();

        $data['sign_name']   = SignName::get();

        $data['info'] = Affidavit::find($id);

        return view('affidavit.view_en', $data);
    }

    /**
    * Edit Affidavit
    */

    public function edit_inherit($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'inheritanceCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Affidavit::where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();


        $data['info'] = $info = Affidavit::find($id);
        $data['inherit'] = Inherit::get();

        return view('affidavit.edit_inherit', $data);
    }

    /**
    * Edit Family
    */

    public function editFamily($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'familyCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Affidavit::where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();


        $data['info'] = $info = Affidavit::find($id);
        $data['inherit'] = Family::get();

        return view('affidavit.edit_family', $data);
    }

    /**
    * Edit Affidavit
    */

    public function editMarried($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'marriedCertificate';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Affidavit::where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $data['info'] = $info = Affidavit::find($id);
        $data['inherit'] = Inherit::get();

        return view('affidavit.edit_married', $data);
    }

    /**
    * Edit Affidavit
    */

    public function edit($id) {
        $data['asideMenu']    = 'affidavit';
        $data['asideSubmenu'] = 'allAffidavit';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Affidavit::where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        /*$select = ['affidavits.*', 'members.name', 'members.father_name', 'members.mother_name', 'members.mobile_no',
                    'members.annual_assessment', 'members.village', 'members.holding_no', 'members.division_id',
                    'members.district_id', 'members.upazila_id', 'members.union_id', 'members.ward_id'];

        $data['info'] = DB::table('affidavits')->join('members', 'affidavits.member_id', '=', 'members.id')->select($select)->where('affidavits.id',$id)->first();
        $data['info'] = $info = Affidavit::with('memberInfo')->find($id);*/

        $data['info'] = $info = Affidavit::find($id);
        $data['inherit'] = Inherit::where('affidavit_id',$info->id)->get();

        return view('affidavit.edit', $data);
    }

    /**
    * Update Affidavit
    */

    public function update(Request $request) {

        $data = Affidavit::findOrFail($request->id);

        $data->created          = $request->created;
        $data->affidavit_no     = numberFilter($request->affidavit_no);
        $data->member_name      = $request->member_name;
        $data->father_name      = $request->father_name;
        $data->mother_name      = $request->mother_name;
        $data->district_id      = $request->district_id;
        $data->upazila_id       = $request->upazila_id;
        $data->union_id         = $request->union_id;
        $data->ward_id          = $request->ward_id;
        $data->holding_no       = numberFilter($request->holding_no);
        $data->post_office      = $request->post_office;
        $data->village          = $request->village;
        $data->member_name_en   = $request->member_name_en;
        $data->father_name_en   = $request->father_name_en;
        $data->mother_name_en   = $request->mother_name_en;
        $data->post_office_en   = $request->post_office_en;
        $data->village_en       = $request->village_en;
        $data->nid              = numberFilter($request->nid_no);
        $data->mobile           = numberFilter($request->mobile_no);
        $data->affidavit_type   = $request->affidavit_type;

        $data->memorial_no      = numberFilter($request->memorial_no);

        if (!empty($request->file('affidavit_image'))) {
            if (file_exists($data->path)) unlink($data->path);
            $data->path = uploadFile($request->file('affidavit_image'), 'public/uploads/affidavit');
        }

        $data->save();
        $id = $data->id;

        /* Store Affidavit Inheritance Function */
        if($request->affidavit_type == "inheritance_certificate"){
            foreach($request->inherit_name as $key => $inheritName){
                if(!empty($inheritName->inherit_name)){
                    $data2 = Inherit::where('affidavit_id',$id)->findOrFail($request->inherit_id[$key]);

                    $data2->affidavit_id     = $id;
                    $data2->created          = $request->created;
                    $data2->inherit_name     = $inheritName;
                    $data2->inherit_dob      = $request->inherit_dob[$key];
                    $data2->inherit_year     = $request->inherit_year[$key];
                    $data2->inherit_relation = $request->inherit_relation[$key];
                    $data2->inherit_remarks  = $request->inherit_remarks[$key];

                    $data2->save();
                }
            }
        }
        $message = ['update' => 'Affidavit update successful.'];
        return redirect()->route('admin.affidavit')->with($message);
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy($id) {
        Affidavit::find($id)->delete();
        return redirect()->route('admin.affidavit')->with(['delete' => 'Affidavit successfully deleted.']);
    }

    public function memberInfo(Request $request) {
        if(!empty($request->id)){
            if(!empty($request->select_id)){
                $partyInfo = DB::table('members')->where('id', $request->select_id)->first();
            }else{
                $partyInfo = DB::table('members')->where('id', $request->id)->first();
            }
            $data = [
                'id'                => $partyInfo->id,
                'name'              => $partyInfo->name,
                'father_name'       => $partyInfo->father_name,
                'holding_no'        => $partyInfo->holding_no,
                'mobile_no'         => $partyInfo->mobile_no,
                'ward_id'           => $partyInfo->ward_id,
                'annual_assessment' => $partyInfo->annual_assessment,
                'taxes'             => $partyInfo->taxes,
            ];
             return (object)$data;
        }
    }
    public function getAllData(Request $request) {
        $inheritance = [];
        if(!empty($request->id)){
            $inheritance = DB::table('inheritance')->where('id', $request->id)->first();
        }
        return (object)$inheritance;
    }

    public function wardWiseMember(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';
        if (!empty($request->ward_id)) {
            $where[] = ['ward_id', $request->ward_id];
            // get user data
            $data['userInfo'] = $userInfo = Auth::user();
            if ($userInfo->privilege == 'user') {
                if (!empty($userInfo->union_id)) {
                    $where[] = ['union_id', $userInfo->union_id];
                }
            }
            $results = DB::table('members')->where($where)->get();
            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected>' .' (' . $row->holding_no . ') ' . $row->name . ' - ' . $row->mobile_no . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '" >' .' (' . $row->holding_no . ') ' . $row->name . ' - ' . $row->mobile_no . '</option>';
                    }
                }
            }
        }
        echo $option;
    }
}
