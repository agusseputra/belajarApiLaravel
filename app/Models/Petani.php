<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Petani extends Model
{
    use HasFactory;
    public $primaryKey = 'id_kelompok_tani';
    protected $fillable = [
        'nama', 'nik', 'alamat', 'telp', 'foto', 'idKelompokTani', 'status',
    ];
    static function getPetani()
    {
        $return=DB::table('petani')
        ->join('kelompok_tani','petani.id_kelompok_tani','=','kelompok_tani.id_kelompok_tani');
        return $return;
    }
}
