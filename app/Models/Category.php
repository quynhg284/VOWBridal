<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Allow mass assignment for fields
    protected $fillable = ['id', 'name', 'image', 'status'];
    
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'idcategory', 'id');
    }   
}
