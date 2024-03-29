<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
