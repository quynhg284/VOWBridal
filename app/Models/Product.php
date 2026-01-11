<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
     use HasFactory;

    protected $table = 'products';

    // Allow mass assignment for the name field
      protected $fillable = ['id','title','image','content','description','price','status','idcategory'];

    public function category()
    {
        // use the actual foreign key column `idcategory`
        return $this->belongsTo(\App\Models\Category::class, 'idcategory', 'id');
    }
}