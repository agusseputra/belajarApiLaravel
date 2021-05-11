<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public $primaryKey = 'product_id';
    protected $fillable = [
         'category_id', 'code', 'name', 'description', 'status','cover'
     ];
    static function get_ll()
    {
        $return=DB::table('products')
        ->join('categories','products.category_id','=','categories.category_id');
        return $return;
    }
}
