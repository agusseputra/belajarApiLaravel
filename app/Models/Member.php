<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'avatar','gender'
     ];
}
