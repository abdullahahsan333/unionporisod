<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\BazarMember;
use App\Models\TaxCollection;
use Illuminate\Http\Request;
use App\Models\BanglaNumberToWord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxCollectionController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * All Tax Collection
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'tax_collection';
        $data['asideSubmenu'] = 'allTaxCollection';

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
                $where[] = ['members.union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();

        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['members.id', $request->member_id];
            }
            if (!empty($request->date_from)) {
                $where[] = ['tax_collections.created', '>=', $request->date_from];
            }
            if (!empty($request->date_to)) {
                $where[] = ['tax_collections.created', '<=', $request->date_to];
            }
            if (!empty($request->ward_id)) {
                $where[] = ['members.ward_id', $request->ward_id];
            }
            if (!empty($request->receipt_no)) {
                $where[] = ['tax_collections.receipt_no', $request->receipt_no];
            }

        } else {
            $where[] = ['tax_collections.created', date('Y-m-d')];
        }

        $data['results'] = DB::table('tax_collections')
            ->join('members', 'tax_collections.member_id', '=', 'members.id')
            ->select('tax_collections.*', 'members.name', 'members.father_name', 'members.mother_name', 'members.mobile_no', 'members.village', 'members.holding_no', 'members.division_id', 'members.district_id', 'members.upazila_id', 'members.union_id', 'members.ward_id')
            ->where($where)
            ->get();

        return view('tax-collection.index', $data);
    }

    /**
     * Create member
     */
    public function create(Request $request) {
        $data['asideMenu']    = 'tax_collection';
        $data['asideSubmenu'] = 'addTaxCollection';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $userId = (!empty($request->id) ? strDecode($request->id) : '');
        
        $data['memberInfo'] = Member::find($userId);
        
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        $data['allMember'] = Member::select('id', 'name', 'mobile_no', 'holding_no', 'ward_id', 'householder')->where($where)->get();

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $view = empty($userId) ? 'tax-collection.create' : 'tax-collection.member-collection';
        return view($view, $data);
    }
    /**
     * Create member
     */
    public function bazar(Request $request) {
        $data['asideMenu']    = 'tax_collection';
        $data['asideSubmenu'] = 'addTaxCollection';

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $userId = (!empty($request->id) ? strDecode($request->id) : '');
        
        $data['memberInfo'] = BazarMember::find($userId);
        
        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }
        
        $data['allMember'] = BazarMember::select('id', 'holder_name', 'mobile_no', 'holding_no', 'ward_id', 'business_name')->where($where)->get();

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $view = empty($userId) ? 'tax-collection.bazar' : 'tax-collection.member-collection';
        return view($view, $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {
        $data = new TaxCollection();

        $data->type              = $request->type;
        $data->created           = $request->created;
        $data->receipt_no        = $request->receipt_no;
        $data->member_id         = $request->member_id;
        $data->year              = $request->finence_year;
        $data->annual_assessment = numberFilter($request->annual_assessment);
        $data->taxes             = numberFilter($request->taxes);
        $data->paid              = numberFilter($request->paid);
        $data->fine              = numberFilter($request->fine);
        $data->total             = numberFilter($request->total);

        /*if (!empty($request->file('collection_image'))) {
            $data->path = uploadFile($request->file('collection_image'), 'public/uploads/collection-image');
        }*/

        $data->save();

        $message = ['success' => 'Tax Collection update successful.'];

        return redirect()->route('admin.tax-collection.create')->with($message);
    }

    /**
     * View member
     */
    public function view($id) {
        $data['asideMenu']    = 'tax_collection';
        $data['asideSubmenu'] = 'allTaxCollection';
        
        $data['privilege'] = Auth::user()->privilege;
        
        $data['obj'] = new BanglaNumberToWord();

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        $data['info'] = TaxCollection::find($id);
        
        $data['member'] = Member::get();

        return view('tax-collection.view', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'tax_collection';
        $data['asideSubmenu'] = 'allTaxCollection';

        $data['allMember'] = Member::where('deleted_at', null)->get();
        
        $data['privilege'] = Auth::user()->privilege;

        $data['divisions'] = DB::table('divisions')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['upazilas']  = DB::table('upazilas')->get();
        $data['unions']    = DB::table('unions')->get();
        $data['wards']     = DB::table('wards')->get();

        //$data['info'] = TaxCollection::find($id);
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();

        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['info'] = $info = TaxCollection::with('memberInfo')->find($id);
        
        $data['previousPaid'] = DB::table('tax_collections')->where('member_id', $info->member_id)->sum('paid');
        
        return view('tax-collection.edit', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = TaxCollection::find($request->id);

        $data->member_id         = $request->member_id;
        $data->year              = $request->finence_year;
        $data->receipt_no        = numberFilter($request->receipt_no);
        $data->annual_assessment = numberFilter($request->annual_assessment);
        $data->taxes             = numberFilter($request->taxes);
        $data->paid              = numberFilter($request->paid);
        $data->fine              = numberFilter($request->fine);
        $data->total             = numberFilter($request->total);

        $data->save();
        $message = ['update' => 'Tax Collection update successful.'];
        return redirect()->route('admin.tax-collection')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        TaxCollection::find($id)->delete();

        return redirect()->route('admin.tax-collection')->with(['delete' => 'Tax Collection successfully deleted.']);
    }

    public function memberInfo(Request $request) {
        if (!empty($request->id)) {
            $partyInfo = DB::table('members')->where('id', $request->id)->first();
            $tranInfo  = DB::table('tax_collections')->where('member_id', $request->id)->sum('paid');

            $data = [
                'id'                => $partyInfo->id,
                'father_name'       => $partyInfo->father_name,
                'holding_no'        => $partyInfo->holding_no,
                'mobile_no'         => $partyInfo->mobile_no,
                'ward_id'           => $partyInfo->ward_id,
                'estimated_value'   => $partyInfo->estimated_value,
                'annual_assessment' => $partyInfo->annual_assessment,
                'annual_income'     => $partyInfo->annual_income,
                'taxes'             => $partyInfo->taxes,
                'previous_paid'     => (!empty($tranInfo) ? $tranInfo : 0),
            ];
            return (object)$data;
        }
    }
    public function wardWiseMember(Request $request) {
        $option = '<option value="" selected>সদস্য নির্বাচন করুন</option>';

        if (!empty($request->ward_id)) {
            if(!empty($request->union_id)){
                $where = [['ward_id', $request->ward_id],['union_id', $request->union_id]];
            }else{
                $where = ['ward_id', $request->ward_id];
            }
            // get user data
            $data['userInfo'] = $userInfo = Auth::user();

            /*if ($userInfo->privilege == 'user') {
                if (!empty($userInfo->union_id)) {
                    $where[] = ['union_id', $userInfo->union_id];
                }
            }*/

            $results = DB::table('members')->where($where)->get();

            if (!empty($results)) {
                foreach ($results as $row) {
                    if (!empty($request->select_id) && $request->select_id == $row->id) {
                        $option .= '<option value="' . $row->id . '" selected >' .' (' . $row->holding_no . ') ' . $row->name . ' - ' . $row->mobile_no . '</option>';
                    } else {
                        $option .= '<option value="' . $row->id . '" >' .' (' . $row->holding_no . ') ' . $row->name . ' - ' . $row->mobile_no . '</option>';
                    }
                }
            }
        }
        echo $option;
    }
}
