<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chairman extends Model {
    use HasFactory, SoftDeletes;


    /**
    *Get the post that owns the comment.
    */
    public function memberInfo() {
        $select = [ 'id','holding_no','name','father_name','mobile_no','householder','district_id','upazila_id',
                    'union_id','village','ward_id','annual_assessment','deleted_at'];
        
        return $this->belongsTo(Member::class,'member_id','id')->select($select);
    }
}