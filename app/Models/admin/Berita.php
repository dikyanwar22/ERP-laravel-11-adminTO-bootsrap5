<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory; 
    protected $table = 'berita';
    protected $primarykey = 'id';
    protected $fillable = ['judul', 'gambar', 'isi', 'penulis', 'deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
