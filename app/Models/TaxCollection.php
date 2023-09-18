<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxCollection extends Model {
    use HasFactory, SoftDeletes;

    /**
    *Get the post that owns the comment.
    */
    public function memberInfo() {
        $select = [ 'id','holding_no','name','father_name','mobile_no','householder','division_id','district_id','upazila_id',
                    'union_id','village','ward_id','estimated_value','annual_assessment','taxes','deleted_at'];
        
        return $this->belongsTo(Member::class,'member_id','id')->select($select);
    }
}