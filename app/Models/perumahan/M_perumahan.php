<?php

namespace App\Models\perumahan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_perumahan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'email', 'telp', 'pesan', 'deleted', 'created_at', 'updated_at'];
}
