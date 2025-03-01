<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $table = 'carousel';
    protected $primarykey = 'id';
    protected $fillable = ['img', 'teks', 'deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
