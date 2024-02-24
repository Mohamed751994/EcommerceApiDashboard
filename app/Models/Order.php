<?php

namespace App\Models;

use App\Http\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,HelperTrait;
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }

    public function languageIcon()
    {
        return $this->belongsTo('App\Models\Language', 'language');
    }

    public function getStatusAttribute($value)
    {
        //[ 0 => 'pending' , 1 =>'payment_pending' , 2 =>'approved' , 3 => 'cancelled', 4 => 'rejected']
        switch ($value) {
            case "0":
                return ['index'=>0 ,'status' => __('text.pending'), 'class'=>'warning'];
                break;
            case "1":
                return ['index'=>1 ,'status' => __('text.payment_pending'), 'class'=>'warning'];
                break;
            case "2":
                return ['index'=>2 ,'status' => __('text.shipping'), 'class'=>'info'];
                break;
            case "3":
                return ['index'=>3 ,'status' => __('text.approved'), 'class'=>'success'];
                break;
            case "4":
                return ['index'=>4 ,'status' => __('text.cancelled'), 'class'=>'danger'];
                break;
            case "5":
                return ['index'=>5 ,'status' => __('text.rejected'), 'class'=>'danger'];
                break;
            default:
                return ['index'=>0 ,'status' => __('text.pending'), 'class'=>'warning'];
        }

    }


}
