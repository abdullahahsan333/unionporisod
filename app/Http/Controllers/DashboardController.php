<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\BazarMember;
use App\Models\SignName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['asideMenu']    = 'dashboard';
        $data['asideSubmenu'] = '';

        //dd(config('custom.religion'));

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();

        $unionId       = Auth::user()->union_id;
        $data['wards'] = DB::select("SELECT members.union_id, members.ward_id, wards.name_bn, IFNULL(COUNT(*), 0) AS total_member FROM `members` JOIN wards ON members.ward_id=wards.id WHERE members.union_id='$unionId' AND members.deleted_at IS NULL GROUP BY members.ward_id ORDER BY members.ward_id");

        $data['privilege'] = Auth::user()->privilege;

        // get total member
        $unionId = '';
        if(Auth::user()->privilege == 'user'){
            $unionId = ' AND union_id = ' . Auth::user()->union_id;
        }
        $data['chairman'] = SignName::where(['union_id' => Auth::user()->union_id])->get();

        $memberList = DB::select("SELECT COUNT(*) AS qty FROM `members` WHERE deleted_at IS NULL {$unionId}");

        $data['allMember']   = (!empty($memberList[0]->qty) ? $memberList[0]->qty : 0);
        $data['allUpazila']  = count($data['upazilas']);
        $data['allUnion']    = count($data['unions']);

        $lowerClass = DB::select("SELECT COUNT(*) AS qty FROM `members` WHERE `poverty_line` = 'নিম্নবিত্ত' AND deleted_at IS NULL {$unionId}");
        $middleClass = DB::select("SELECT COUNT(*) AS qty FROM `members` WHERE `poverty_line` = 'মধ্যবিত্ত' AND deleted_at IS NULL {$unionId}");
        $upplerClass = DB::select("SELECT COUNT(*) AS qty FROM `members` WHERE `poverty_line` = 'উচ্চবিত্ত' AND deleted_at IS NULL {$unionId}");

        $data['lowerClass'] = (!empty($lowerClass[0]->qty) ? $lowerClass[0]->qty : 0);
        $data['middleClass'] = (!empty($middleClass[0]->qty) ? $middleClass[0]->qty : 0);
        $data['upplerClass'] = (!empty($upplerClass[0]->qty) ? $upplerClass[0]->qty : 0);

        $info = DB::select("SELECT SUM(member_male) AS male_qty, SUM(member_female) AS female_qty, SUM(taxes) AS amount  FROM `members` WHERE deleted_at IS NULL {$unionId}");
        $data['totalMale'] = (!empty($info[0]->male_qty) ? $info[0]->male_qty : 0);
        $data['totalFemale'] = (!empty($info[0]->female_qty) ? $info[0]->female_qty : 0);
        $data['totalTaxes'] = (!empty($info[0]->amount) ? $info[0]->amount : 0);

        $bazarMemberList = DB::select("SELECT COUNT(*) AS qty, SUM(total_taxes) AS totalTaxes FROM `bazar_members` WHERE deleted_at IS NULL {$unionId}");

        $data['allBazarMember'] = (!empty($bazarMemberList[0]->qty) ? $bazarMemberList[0]->qty : 0);
        $data['allBazarMemberTax'] = (!empty($bazarMemberList[0]->totalTaxes) ? $bazarMemberList[0]->totalTaxes : 0);
        
        $data['socialSecurityBGD']          = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'ভিজিডি', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityBGF']          = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'ভিজিএফ', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityOld']          = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'বয়স্ক ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityMother']       = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'মাতৃত্ব ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityWidow']        = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'বিধবা ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityDisability']   = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'প্রতিবন্ধী ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityFreedom']      = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'মুক্তিযোদ্ধা ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityPregnant']     = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'গর্ভবতী ভাতা', 'social_security_act' => 'হ্যাঁ'])->get();
        $data['socialSecurityOther']        = Member::where(['union_id' => Auth::user()->union_id, 'social_act_name' => 'অন্যান্য', 'social_security_act' => 'হ্যাঁ'])->get();

        return view('dashboard', $data);
    }
}
