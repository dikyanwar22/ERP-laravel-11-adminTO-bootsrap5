<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//default routing
Route::get('/', [App\Http\Controllers\perumahan\Home::class, 'index']);

Route::controller(App\Http\Controllers\Auth\LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');

    //nanti ini dihapus saja
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

//modul & Menu & Sub Menu
// example url : http://127.0.0.1:8000/modul
Route::controller(App\Http\Controllers\ModulController::class)->group(function() {
    //Modul
    Route::get('/modul', 'modul')->name('modul');
    Route::get('/add-modul', 'modul_add')->name('modul_add');
    Route::post('/add-modul-action', 'modul_add_action')->name('modul_add_action');
    Route::get('/modul-edit/{id}', 'modul_edit')->name('modul_edit');
    Route::put('/modul-update/{id}', 'modul_update')->name('modul_update');

    //Menu
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/add-menu', 'menu_add')->name('menu_add');
    Route::post('add-menu-action', 'menu_add_action')->name('menu_add_action');
    Route::get('/menu-edit/{id}', 'menu_edit')->name('menu_edit');
    Route::put('menu-update/{id}', 'menu_update')->name('menu_update');

    //Sub Menu
    Route::get('/sub_menu', 'submenu')->name('sub_menu');
    Route::get('/add-submenu', 'submenu_add')->name('submenu_add');
    Route::post('add-submenu-action', 'submenu_add_action')->name('submenu_add_action');
    Route::get('/submenu-edit/{id}', 'submenu_edit')->name('submenu_edit');
    Route::put('submenu-update/{id}', 'submenu_update')->name('submenu_update');

    //untuk menampilkan modul
    Route::get('/tampil_modul', 'tampil_modul')->name('tampil_modul');
    Route::post('/all_menu', 'all_menu')->name('all_menu');
    Route::post('/modul_sub_menu', 'modul_sub_menu')->name('modul_sub_menu');
})->middleware('authenticate');
//modul & Menu & Sub Menu

//Membuat dokumentasi API
// example url : http://127.0.0.1:8000/api/Documentation
Route::controller(App\Http\Controllers\Api\Documentation::class)->group(function() {
  Route::get('/api/Documentation', 'index')->name('index_api');
  Route::post('/api/Documentation/api_add', 'api_add')->name('api_add');
  Route::get('/api/Documentation/editModal/{item}', 'editModal')->name('editModal');
  Route::put('/api/Documentation/api_edit', 'api_edit')->name('api_edit');
  Route::get('/api/Documentation/deleted_api/{item}', 'deleted_api')->name('deleted_api');
  Route::get('/api/Documentation/list_api/{item}', 'list_api')->name('list_api');
  Route::get('/api/Documentation/add_list_api/{item}', 'add_list_api')->name('add_list_api');
  Route::post('/api/Documentation/action_add_list_api', 'action_add_list_api')->name('action_add_list_api');
  Route::get('api/Documentation/edit_list_api/{item1}/{item2}', 'edit_list_api')->name('edit_list_api');
  Route::get('/api/Documentation/deleted_list_api/{item}', 'deleted_list_api')->name('deleted_list_api');
  Route::get('/api/Documentation/result/{item}', 'result')->name('result');
  Route::put('api/Documentation/action_edit_list_api/{item}', 'action_edit_list_api')->name('action_edit_list_api');
})->middleware('authenticate');
//Membuat dokumentasi API

//membuat dokumentasi ERP
// example url : http://127.0.0.1:8000/erp/Documentation/modul
Route::controller(App\Http\Controllers\Documentation::class)->group(function() {
  Route::prefix('erp/Documentation')->group(function () {
    Route::get('modul', 'index');
    Route::get('getModul', 'getModul');
    Route::post('insertModul', 'insertModul');
    Route::post('fetchModul', 'fetchModul');
    Route::get('deleteModul/{item}', 'deleteModul');
    Route::post('updateModul', 'updateModul');

    Route::get('menu/{item}', 'menu');
    Route::get('getMenu', 'getMenu');
    Route::post('fetchMenu', 'fetchMenu');
    Route::post('insertMenu', 'insertMenu');
    Route::post('updateMenu', 'updateMenu');
    Route::get('deleteMenu/{item}', 'deleteMenu');

    Route::get('submenu/{item}', 'submenu');
    Route::get('deleteSubMenu/{item}', 'deleteSubMenu');
    Route::get('getSubMenu', 'getSubMenu');
    Route::post('fetchSubMenu', 'fetchSubMenu');
    Route::post('insertSubMenu', 'insertSubMenu');
    Route::post('updateSubMenu', 'updateSubMenu');
  });
})->middleware('authenticate');
//membuat dokumentasi ERP


//Admin
//first route
//gunakan link ini untuk pertama kali route
Route::get('/erp', [App\Http\Controllers\WelcomeController::class, 'index'])->middleware('authenticate');

//modul notifikasi
Route::controller(App\Http\Controllers\NotifController::class)->group(function() {
  Route::get('/my_notification', 'my_notification')->name('my_notification');
})->middleware('authenticate');
//modul notifikasi

// Admin routes with 'authenticate' middleware || jadikan ini panduan untuk contoh
Route::prefix('Admin')->middleware('authenticate')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\Dashboard::class, 'index']); 
    Route::get('/Dashboard', [App\Http\Controllers\Admin\Dashboard::class, 'index']);
    Route::get('/Informasi/Carousel', [App\Http\Controllers\Admin\Pertanyaan::class, 'index']);
});

Route::prefix('Profile')->middleware('authenticate')->group(function () {
  Route::get('/', [App\Http\Controllers\Profile\Profile::class, 'index']);
});

Route::prefix('Helpdesk')->middleware('authenticate')->group(function () {
  Route::get('/', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'index']);
  Route::post('data_main', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'data_main']);
  Route::get('create', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'create']);
  Route::get('detail_inbox/{item}', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'detail_inbox']);
  Route::post('look_helpdesk', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'look_helpdesk']);
  Route::get('download/{item}', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'download']);

  Route::get('cat_helpdesk', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'cat_helpdesk']);
  Route::get('level', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'level']);
  Route::post('sending_helpdesk', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'sending_helpdesk']);
  Route::post('reply_helpdesk', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'reply_helpdesk']);

  Route::get('Category', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'category']);
  Route::get('data_category', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'data_category']);
  Route::post('insert_category', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'insert_category']);
  Route::get('detail_modal', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'detail_modal']);
  Route::post('det_cat', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'det_cat']);
  Route::post('update_category', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'update_category']);


  Route::get('/helpdesk_in', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'helpdesk_in']);
});









Route::get('/Admin/Berita', [App\Http\Controllers\admin\Berita::class, 'index']);
Route::post('/Admin/Berita', [App\Http\Controllers\admin\Berita::class, 'index']);
Route::get('/Admin/Berita/Tambah', [App\Http\Controllers\admin\Berita::class, 'create']);
Route::post('/Admin/Berita/TambahBerita', [App\Http\Controllers\admin\Berita::class, 'store']);
Route::get('/Admin/Berita/Edit/{item}', [App\Http\Controllers\admin\Berita::class, 'edit']);
Route::put('/Admin/Berita/EditBerita/{item}', [App\Http\Controllers\admin\Berita::class, 'update']);
Route::get('/Admin/Berita/Hapus/{item}', [App\Http\Controllers\admin\Berita::class, 'destroy']);

Route::get('/Admin/Pengaturan/Info', [App\Http\Controllers\admin\Info::class, 'index']);
Route::put('/Admin/Pengaturan/Update/{item}', [App\Http\Controllers\admin\Info::class, 'update']);

Route::get('/Admin/Pengaturan/Carousel', [App\Http\Controllers\admin\Carousel::class, 'index']);
Route::post('/Admin/Pengaturan/Store', [App\Http\Controllers\admin\Carousel::class, 'store']);
Route::get('/Admin/Pengaturan/Destroy/{item}', [App\Http\Controllers\admin\Carousel::class, 'destroy']);
Route::put('/Admin/Pengaturan/Update/{item}', [App\Http\Controllers\admin\Carousel::class, 'update']);


//Contoh GENERATE PDF
Route::get('/pdf', [App\Http\Controllers\WelcomeController::class, 'generatePDF']);

//Contoh Import Excel
Route::post('import_excel', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'import_excel']);

//Contoh Export Excel
Route::get('export_excel', [App\Http\Controllers\Helpdesk\Helpdesk::class, 'export_excel']);

//Contoh Membuat tanda tangan digital (signature)
Route::get('tanda_tangan', [App\Http\Controllers\SignatureController::class, 'index']);
Route::post('signature', [App\Http\Controllers\SignatureController::class, 'store']);
// Menampilkan tanda tangan berdasarkan ID
Route::get('tanda_tangan/{item}', [App\Http\Controllers\SignatureController::class, 'show']);

//menampilkan QR Code dengan Generate
Route::get('show_qr', [App\Http\Controllers\SignatureController::class, 'show_qr']);
//menampilkan QR Code static
Route::get('show_static_qr', [App\Http\Controllers\SignatureController::class, 'show_static_qr']);

//membuat generate nomor otomatis yang tidak ada batas
Route::get('auto-number', [App\Http\Controllers\AutoNumberController::class, 'index']);
Route::get('generate-number', [App\Http\Controllers\AutoNumberController::class, 'generate']);

//Membuat kamera
Route::get('camera', [App\Http\Controllers\AutoNumberController::class, 'camera']);

//Index
Route::get('/Contact-us', [App\Http\Controllers\perumahan\Contact::class, 'index']);
Route::post('/post-question', [App\Http\Controllers\perumahan\Contact::class, 'store']);

//contoh CRUD
Route::resource('/posts', \App\Http\Controllers\PostController::class);
