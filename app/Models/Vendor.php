<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = [
         'name','mobile', 'email','address','logo','category_id','active','created_at','updated_at',
    ];
    protected $hidden =['category_id'];
    public function category()
    {
        return $this->belongsTo('\App\Models\Main_category');
    }

    public function scopeActive($query)
    {
        return $query->where('active','1');
    }
    public function getActive()
    {
         return $this->active == 1 ?  ' مفعل ' : 'غير مفعل ';
    }
    public function scopeSelection( $query)
    {
        return $query->select('id','category_id','name','mobile','logo','active');
    }
}
