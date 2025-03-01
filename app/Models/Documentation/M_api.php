<?php

namespace App\Models\Documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_api extends Model {

  use HasFactory;
  protected $table = 'api';
  protected $primarykey = 'id';
  protected $fillable = ['nama', 'deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];

  public function view_api() {
    $db = DB::table('api')
    ->select('*')
    ->where('deleted', '0')
    ->get();
    return $db;
  }

  public function edit_api($data, $id) {
    $db = DB::table('api')
    ->where('id', $id)
    ->update($data);
    return true;
  }

  public function insert_api($data) {
    $db = DB::table('api')
    ->insert($data);
    return true;
  }

  public function db_api($id) {
    $db = DB::table('api')
    ->select('*')
    ->where('id',$id)
    ->where('deleted', '0')
    ->first();
    return $db;
  }

  public function list_api($id) {
    $db = DB::table('api_list')
    ->select('*')
    ->where('api_id', $id)
    ->where('deleted', '0');
    return $db;
  }

  public function edit_list_api($data, $id) {
    $db = DB::table('api_list')
    ->where('id', $id)
    ->update($data);
    return true;
  }

  public function db_view($id_var) {
    $db = DB::table('api_list')
    ->where('id', $id_var)
    ->where('deleted', '0')
    ->first();
    return $db;
  }

  public function db_add_api($data) {
    $db = DB::table('api_list')
    ->insert($data);
    return true;
  }

  public function db_edit_api($data, $id) {
    $db = DB::table('api_list')
    ->where('id', $id)
    ->update($data);
    return true;
  }

}
