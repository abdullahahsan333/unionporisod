<?php

namespace App\Http\Controllers;

use App\Models\SignName;
use App\Models\Member;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * All Notice
     */
    public function index(Request $request) {
        $data['asideMenu']    = 'notice';
        $data['asideSubmenu'] = 'allNotice';
        
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

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        $where = [];
        if (!empty($request->_token)) {
            if (!empty($request->member_id)) {
                $where[] = ['notices.member_id', $request->member_id];
            }
    
            if (!empty($request->date_from)) {
                $where[] = ['notices.created','>=', $request->date_from];
            }
    
            if (!empty($request->date_to)) {
                $where[] = ['notices.created','<=', $request->date_to];
            }
            
            if (!empty($request->district_id)) {
                $where[] = ['members.district_id', $request->district_id];
            }

            if (!empty($request->upazila_id)) {
                $where[] = ['members.upazila_id', $request->upazila_id];
            }

            if (!empty($request->union_id)) {
                $where[] = ['members.union_id', $request->union_id];
            }
    
            if (!empty($request->ward_id)) {
                $where[] = ['members.ward_id', $request->ward_id];
            }
        } else{
            $where[] = ['notices.created', date('Y-m-d')];
        }
        
        $select = ['notices.*', 'members.name', 'members.father_name', 'members.mother_name', 'members.mobile_no',
                'members.annual_assessment', 'members.village', 'members.holding_no', 'members.division_id', 'members.district_id',
                'members.upazila_id', 'members.union_id', 'members.ward_id'];
        
        $data['results'] = DB::table('notices')
            ->join('members', 'notices.member_id', '=', 'members.id')
            ->select($select)
            ->where($where)
            ->get();

        return view('notice.index', $data);
    }

    /**
     * Create Notice
     */
    public function create() {
        $data['asideMenu']    = 'notice';
        $data['asideSubmenu'] = 'addNotice'; 

        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $data['wards'] = DB::table('wards')->get();

        return view('notice.create', $data);
    }

    /**
     * Store member
     */
    public function store(Request $request) {

        $notice = [];

        $data = New Notice();

        $data->created     = $request->created;
        $data->memorial_no = numberFilter($request->memorial_no);
        $data->formula     = $request->formula;
        $data->member_id   = $request->member_id;
        $data->balance     = numberFilter($request->balance);

        /*if (!empty($request->file('collection_image'))) {
            $data->path = uploadFile($request->file('collection_image'), 'public/uploads/collection-image');
        }*/

        $data->save();

        $message = ['success' => 'Notice update successful.'];


        $notice = Notice::orderBy('id', 'desc')->where('deleted_at',null)->get();
        $id = $notice[0]->id;

        return redirect()->route('admin.notice.view',$id)->with($message);
    }

    /**
     * View member
     */
    public function view($id) {
        $data['asideMenu']    = 'notice';
        $data['asideSubmenu'] = 'allNotice';

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();
        
        $data['sign_name']   = SignName::get();
        
        $data['privilege'] = Auth::user()->privilege;
        
        $data['info'] = DB::table('notices')
            ->join('members', 'notices.member_id', '=', 'members.id')
            ->select('notices.*', 'members.name', 'members.father_name', 'members.mother_name', 'members.mobile_no', 'members.annual_assessment', 'members.village', 'members.holding_no', 'members.division_id', 'members.district_id', 'members.upazila_id', 'members.union_id', 'members.ward_id')
            ->where('notices.id',$id)
            ->first();

        //$data['info'] = Notice::with('memberInfo')->find();

        return view('notice.view', $data);
    }

    /**
     * Edit member
     */
    public function edit($id) {
        $data['asideMenu']    = 'notice';
        $data['asideSubmenu'] = 'allNotice';
        
        // get user data
        $data['userInfo'] = $userInfo = Auth::user();
        
        $data['privilege'] = Auth::user()->privilege;

        $where = [];
        if ($userInfo->privilege == 'user') {
            if (!empty($userInfo->union_id)) {
                $where[] = ['union_id', $userInfo->union_id];
            }
        }

        $data['allMember'] = Member::where($where)->get();

        $data['divisions']  = DB::table('divisions')->get();
        $data['districts']  = DB::table('districts')->get();
        $data['upazilas']   = DB::table('upazilas')->get();
        $data['unions']     = DB::table('unions')->get();
        $data['wards']      = DB::table('wards')->get();

        //$data['info'] = Notice::find($id);
        
        $data['info'] = DB::table('notices')
            ->join('members', 'notices.member_id', '=', 'members.id')
            ->select('notices.*', 'members.name', 'members.father_name', 'members.mother_name', 'members.mobile_no', 'members.annual_assessment', 'members.village', 'members.holding_no', 'members.division_id', 'members.district_id', 'members.upazila_id', 'members.union_id', 'members.ward_id')
            ->where('notices.id',$id)
            ->first();

        //$data['info'] = $info = Notice::with('memberInfo')->find($id);


        return view('notice.edit', $data);
    }

    /**
     * Update member
     */
    public function update(Request $request) {
        $data = Notice::find($request->id);

        $data->created     = $request->created;
        $data->memorial_no = numberFilter($request->memorial_no);
        $data->formula     = $request->formula;
        $data->member_id   = $request->member_id;
        $data->balance     = numberFilter($request->balance);

        /*if (!empty($request->file('collection_image'))) {
            if(file_exists($data->path)) unlink($data->path);
            $data->path = uploadFile($request->file('collection_image'), 'public/uploads/collection-image');
        }*/

        $data->save();
        $message = ['update' => 'Notice update successful.'];
        return redirect()->route('admin.notice')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        Notice::find($id)->delete();
        return redirect()->route('admin.notice')->with(['delete' => 'Notice successfully deleted.']);
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