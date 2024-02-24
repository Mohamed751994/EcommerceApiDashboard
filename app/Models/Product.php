<?php

namespace App\Models;

use App\Http\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,HelperTrait;
    protected $guarded = ['id'];
    protected $appends = ['is_wishlist'];

    //category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //Translations
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id')->where('language_id', getLanguageId());
    }
    //TranslationsRelations
    public function translationRelation()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    public function getImageAttribute($value)
    {
        if(!$value)
            return null;
        else
            return $this->image_full_path($value);
    }
    public function scopeActive($q)
    {
        return $q->whereStatus(1);
    }
    public function scopeSort($q)
    {
        return $q->orderBy('sort', 'asc');
    }

    public function scopeOffer($q)
    {
        return $q->whereOffer(1);
    }

    //Filtration
    public function scopeFilter($query, $params)
    {
        if ( isset($params['category_ids'])) {
            $query->whereIn('category_id', $params['category_ids']);
        }
        if ( isset($params['new'])) {
            $query->where('new', $params['new']);
        }
        if ( isset($params['featured'])) {
            $query->where('featured', $params['featured']);
        }
        if ( isset($params['prices'])) {
            $query->whereHas('translations', function($q) use ($params){
                $q->whereBetween('price', $params['prices']);
            });
        }
        if ( isset($params['sortByPrice'])) {
            $query->whereHas('translations', function($q) use ($params){
                $q->orderBy('price', $params['sortByPrice']);
            });  // $params['sortByPrice'] = ASC or DESC
        }
        return $query;
    }


    public function getIsWishlistAttribute()
    {
        if(\Auth::check())
        {
            $exist = Wishlist::where([['product_id', '=',  $this->id], ['user_id', '=', auth()->user()->id]])->exists();
            if($exist)
            {
                return true;
            }
            return false;
        }
        return false;
    }

}
