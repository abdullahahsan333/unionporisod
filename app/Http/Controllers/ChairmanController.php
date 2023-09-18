<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SignName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChairmanController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /* All Chairman */
    public function index(Request $request) {
        $data['asideMenu']    = 'chairman';
        $data['asideSubmenu'] = 'allChairman';

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
        
        if (!empty($request->_token)) {
            
            if (!empty($request->chairman)) {
                $where[] = ['chairman', 'like', '%'.  $request->chairman. '%'];
            }
    
            if (!empty($request->minister)) {
                $where[] = ['minister', 'like', '%'. $request->minister . '%'];
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
    
            if (!empty($request->date_from)) {
                $where[] = ['created','>=', $request->date_from];
            }
    
            if (!empty($request->date_to)) {
                $where[] = ['created','<=', $request->date_to];
            }
        }

        $data['results'] = SignName::where($where)->get();

        return view('chairman.index', $data);
    }

    /* Create Chairman */
    public function create() {
        $data['asideMenu']    = 'chairman';
        $data['asideSubmenu'] = 'addChairman';
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        return view('chairman.create', $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {

        $chairman = [];

        $data = New SignName();

        $data->created      = $request->created;
        $data->district_id  = $request->district_id;
        $data->upazila_id   = $request->upazila_id;
        $data->union_id     = $request->union_id;
        $data->chairman     = $request->chairman;
        $data->minister     = $request->minister;

        if (!empty($request->file('chairman_image'))) {
            $data->chairman_image = uploadFile($request->file('chairman_image'), 'public/uploads/chairman');
        }

        if (!empty($request->file('minister_image'))) {
            $data->minister_image = uploadFile($request->file('minister_image'), 'public/uploads/chairman');
        }

        $data->save();

        $message = ['success' => 'Chairman update successful.'];
        
        return redirect()->route('admin.chairman.create')->with($message);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'chairman';
        $data['asideSubmenu'] = 'allChairman';
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $data['allMember'] = Member::where('deleted_at',null)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        //$data['info'] = SignName::find($id);

        $data['info'] = $info = SignName::with('memberInfo')->find($id);


        return view('chairman.edit', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = SignName::find($request->id);

        $data->district_id  = $request->district_id;
        $data->upazila_id   = $request->upazila_id;
        $data->union_id     = $request->union_id;
        $data->chairman     = $request->chairman;
        $data->minister     = $request->minister;

        if (!empty($request->file('chairman_image'))) {
            if(file_exists($data->chairman_image)) unlink($data->chairman_image);
            $data->chairman_image = uploadFile($request->file('chairman_image'), 'public/uploads/chairman');
        }

        if (!empty($request->file('minister_image'))) {
            if(file_exists($data->minister_image)) unlink($data->minister_image);
            $data->minister_image = uploadFile($request->file('minister_image'), 'public/uploads/chairman');
        }

        $data->save();
        $message = ['update' => 'Chairman update successful.'];
         return redirect()->route('admin.chairman')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        SignName::find($id)->delete();
        return redirect()->route('admin.chairman')->with(['delete' => 'Chairman successfully deleted.']);
    }

    public function memberInfo(Request $request) {
        if(!empty($request->id)){
            $partyInfo = DB::table('members')->where('id', $request->id)->first();
            //$tranInfo = DB::table('chairmans')->where('member_id', $request->id)->sum('paid');

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
}