<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,HelperTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'image',
        'gender',
        'date_birth',
        'active',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getTypeAttribute($value)
    {
        return ($value == 1) ? 'admin' : 'user';
    }



    public function getEmailVerifiedAtAttribute($value)
    {
        if(request()->is('api/*'))
        {
            return $value;
        }
        return !is_null($value) ? '<span class="badge text-success bg-light-success">'.trans('text.Active').'</span>'
            : '<span class="badge text-danger bg-light-danger">'.trans('text.NotActive').'</span>';
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id')->with('details')->orderBy('id','desc');
    }

    public function getOrdersCountAttribute($value)
    {
        return ($value > 0) ? '<a href="'.route('orders.index').'?user_id='.$this->id.'" class="btn btn-info btn-sm text-white">'.$value.'</a>'
            : '<span class="badge text-danger bg-light-danger">'.$value.'</span>';
    }

    public function wishlists()
    {
        return $this->belongsToMany(Product::class, 'wishlists', 'user_id','product_id')->with('translations');
    }

    //addresses
    public function address()
    {
        return $this->hasOne('App\Models\UserAddress', 'user_id');
    }


}
