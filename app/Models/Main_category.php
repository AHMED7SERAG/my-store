<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Main_category extends Model
{
    protected $table = 'main_categories';
    protected $fillable = [
        'translation_lang', 'translation_of', 'name','slug','photo','active','created_at','updated_at',
    ];

    public function categories()
    {
        return $this->hasMany(Self::class,'translation_of','id');
    }
    
    public function vendors()
    {
        return $this->hasMany('\App\Models\Vendor','category_id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
        return $query->select('id','name','translation_lang','translation_of','slug','photo','active');
    }
}
