<?php

namespace App\Models\Documentation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_erp extends Model {

    use HasFactory;
    protected $table = 'doc_modul';
    protected $primarykey = 'id';
    protected $fillable = ['modul_id', 'deskripsi', 'created_by', 'updated_by', 'deleted', 'created_at', 'updated_at'];

    public function getModul() {
        return DB::table('doc_modul AS a')
            ->select(
                'a.id',
                'b.id AS modul_id',
                'b.nama AS modul',
                'a.deskripsi',
                'c.name',
                DB::raw("GROUP_CONCAT(d.nama ORDER BY d.nama SEPARATOR ', ') AS hak_akses")
            )
            ->join('modul AS b', 'a.modul_id', '=', 'b.id')
            ->join('users AS c', 'a.created_by', '=', 'c.id')
            ->join('level AS d', DB::raw('FIND_IN_SET(d.id, b.level_id)'), '>', DB::raw('0'))
            ->where('a.deleted', '0')
            ->groupBy('a.id', 'b.nama', 'c.name')
            ->orderBy('a.id', 'DESC')
            ->get();
    }
    
    public function getBreadcrumbModul($id) {
        return DB::table('doc_modul AS a')
            ->select('a.id', 'b.id AS modul_id', 'b.nama AS modul')
            ->join('modul AS b', 'a.modul_id', '=', 'b.id')
            ->where('b.id', $id)
            ->first();
    }
    
    public function getBreadcrumbMenu($id) {
        return DB::table('menu AS a')
            ->select('a.id AS menu_id', 'a.nama AS menu', 'b.id AS modul_id', 'b.nama AS modul')
            ->join('modul AS b', 'a.modul_id', '=', 'b.id')
            ->where('a.id', $id)
            ->first();
    }
    
    public function insertDBModul($data) {
        return DB::table('doc_modul')->insert($data);
    }
    
    public function db_updateModul($data, $id) {
        return DB::table('doc_modul')
            ->where('id', $id)
            ->update($data);
    }
    
    public function db_updateMenu($data, $id) {
        return DB::table('doc_menu')
            ->where('id', $id)
            ->update($data);
    }
    
    public function db_updateSubMenu($data, $id) {
        return DB::table('doc_submenu')
            ->where('id', $id)
            ->update($data);
    }
    
    public function insertDBMenu($data) {
        return DB::table('doc_menu')->insert($data);
    }
    
    public function insertDBSubMenu($data) {
        return DB::table('doc_submenu')->insert($data);
    }
    
    public function getMenu($id) {
        return DB::table('doc_menu AS a')
            ->select(
                'a.id',
                'b.id AS menu_id',
                'b.nama AS menu',
                'a.deskripsi',
                'c.name',
                DB::raw("GROUP_CONCAT(d.nama ORDER BY d.nama SEPARATOR ', ') AS hak_akses")
            )
            ->join('menu AS b', 'a.menu_id', '=', 'b.id')
            ->join('users AS c', 'a.created_by', '=', 'c.id')
            ->join('level AS d', DB::raw('FIND_IN_SET(d.id, b.level_id)'), '>', DB::raw('0'))
            ->where('a.deleted', '0')
            ->where('b.modul_id', $id)
            ->groupBy('a.id', 'b.nama', 'c.name')
            ->orderBy('a.id', 'DESC')
            ->get();
    }
    
    public function getSubMenu($id) {
        return DB::table('doc_submenu AS a')
            ->select(
                'a.id',
                'b.nama AS submenu',
                'a.deskripsi',
                'c.name',
                DB::raw("GROUP_CONCAT(d.nama ORDER BY d.nama SEPARATOR ', ') AS hak_akses")
            )
            ->join('sub_menu AS b', 'a.submenu_id', '=', 'b.id')
            ->join('users AS c', 'a.created_by', '=', 'c.id')
            ->join('level AS d', DB::raw('FIND_IN_SET(d.id, b.level_id)'), '>', DB::raw('0'))
            ->where('a.deleted', '0')
            ->where('b.menu_id', $id)
            ->groupBy('a.id', 'b.nama', 'c.name')
            ->orderBy('a.id', 'DESC')
            ->get();
    }
    

}
