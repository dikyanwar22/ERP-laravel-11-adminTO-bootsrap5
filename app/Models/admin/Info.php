<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'info';
    protected $primarykey = 'id';
    protected $fillable = ['logo_perumahan', 'nama_perumahan', 'ket_perumahan', 'alamat', 'telp', 'email', 'link_fb', 'link_ig', 'link_wa', 'url_maps', 'deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
