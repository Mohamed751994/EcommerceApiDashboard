<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    //product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    //language
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
