<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'modul';
    protected $primarykey = 'id';

    public function getModul() {
      $db = DB::table('modul')
            ->select('id', 'nama', 'icon', 'uri', 'level_id', 'deleted')
            ->orderBy('nama', 'ASC')
            ->get();
      return $db;
    }

    public function db_menu() {
        $db = DB::table('menu AS a')
            ->join('modul AS b', 'a.modul_id', '=', 'b.id')
            ->select('a.id', 'a.modul_id', 'a.nama AS menu', 'a.icon', 'a.deleted', 'a.level_id', 'a.uri AS file', 'b.uri AS folder', 'b.nama AS modul')
            // ->groupBy('a.id')
            ->orderBy('a.nama', 'ASC')
            ->get();
      return $db;
    }

    public function db_submenu() {
        $db = DB::table('sub_menu As a')
                ->join('menu AS b', 'a.menu_id', '=', 'b.id')
                ->join('modul AS c', 'b.modul_id', '=', 'c.id')
                ->select('a.id', 'a.icon', 'a.deleted', 'a.level_id', 'a.uri AS function', 'b.uri AS class', 'c.uri AS folder', 'a.nama AS sub_menu', 'b.nama AS menu', 'c.nama AS modul')
                // ->groupBy('a.id')
                ->orderBy('a.nama', 'ASC')
                ->get();
        return $db;
    }

    public function db_modul() {
        $db = DB::table('modul')
              ->select('id', 'icon', 'nama', 'uri', 'level_id', 'deleted')
              ->orderBy('nama', 'ASC')
              ->get();
        return $db;
    }

    public function view_menu($id) {
        $db = DB::table('menu')
              ->select('*')
              ->where('id',$id)
              ->limit(1)
              ->first();
        return $db;
    }

    public function level() {
        $db = DB::table('level')
              ->select('id', 'nama')
              ->where('deleted', '0')
              ->orderBy('nama', 'ASC')
              ->get();
        return $db;
    }

    public function menu_modul() {
        $db = DB::table('menu AS b')
              ->join('modul AS c', 'b.modul_id', '=', 'c.id')
              ->select('b.id', 'b.nama AS menu', 'c.nama AS modul')
              ->where('b.tipe','dropdown')
              // ->groupBy('b.id')
              ->orderBy('b.nama')
              ->get();
        return $db;
    }

    public function db_submenu_row($id) {
        $db = DB::table('sub_menu')
              ->select('*')
              ->where('id',$id)
              ->limit(1)
              ->first();
        return $db;
    }

    public function db_modul_row($id) {
        $db = DB::table('modul')
              ->select('*')
              ->where('id',$id)
              ->limit(1)
              ->first();
        return $db;
    }

}
