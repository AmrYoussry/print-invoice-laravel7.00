<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'product_name',
        'description',
        'section_id',
    ];
    public function sect()
        {
            return $this->belongsTo('app\Section','section_id');
        }
}


