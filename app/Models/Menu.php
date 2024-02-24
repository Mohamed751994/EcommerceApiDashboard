<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // parent relation
    public function parent(){
        return $this->belongsTo(self::class , 'parent_id');
    }
    //child relation
    public function children()
    {
        return $this->hasMany(self::class ,'parent_id');
    }

    public function getNameAttribute($value)
    {
        return (currentLanguage() == 'ar') ?  $value : trans('text.'.$this->route_name.'-index');
    }


}
