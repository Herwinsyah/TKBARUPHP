<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $table = 'pic';
    protected $fillable = ['first_name','last_name','address','email']; 

    public function scopeFilter($query, $id){
    	return $query->where('supplier_id', $id);
    }
    public function phone()
    {
    	return $this->belongsToMany('App\PhoneNumber', 'phone_number_pic');
    }
    public function supplier()
    {
    	return $this->belongsToMany('App\Supplier', 'supplier_pic');
    }
}
