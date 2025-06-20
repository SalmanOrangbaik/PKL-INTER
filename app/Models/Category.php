<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['name', 'slug'];

    //relasi one to many ke product
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
