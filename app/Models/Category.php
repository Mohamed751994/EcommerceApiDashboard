<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    //Translations
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id')->where('language_id', getLanguageId());
    }
    //TranslationsRelations
    public function translationRelation()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }


    //active
    public function scopeActive($q)
    {
        return $q->whereStatus(1);
    }
    public function scopeSort($q)
    {
        return $q->orderBy('sort', 'asc');
    }



}
