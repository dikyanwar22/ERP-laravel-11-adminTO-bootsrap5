<?php

namespace App\Http\Controllers\helpdesk;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\Models\admin\Carousel AS M_carousel;

// excel
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class Helpdesk extends Controller {

    public function __construct() {
        $this->model = new M_carousel();
    }

    public function index(): View
    {
      $data['title'] = 'Helpdesk Inbox';
      $data['carousel'] = M_carousel::orderBy('id', 'DESC')->get();
      return view('helpdesk.index', $data);
    }
    public function data_main(Request $request) {
        try {
            DB::beginTransaction();
      
            // $request->validate([
            //   'id' => 'required|string'
            // ]);

            $currentUserId = auth()->user()->id;
      
            $data = DB::table('helpdesk_inbox AS a')
                ->join('helpdesk_categories AS b', 'a.cat_id', '=', 'b.id')
                ->join('users AS c', 'a.user_id_sender', '=', 'c.id')
                ->select('a.id', 'c.name', 'a.message', 'a.file_upload AS file', 'a.created_at')
                ->where('a.status', '!=', '2')
                ->where(function ($query) use ($currentUserId) {
                    $query->where(function ($subQuery) use ($currentUserId) {
                        $subQuery->whereNotNull('a.user_id_receiver')
                                ->where('a.user_id_receiver', '=', $currentUserId);
                    })->orWhere(function ($subQuery) {
                        $subQuery->whereNull('a.user_id_receiver')
                                ->where('a.level_id', '=', auth()->user()->level_id);
                    });
                })
                ->orderByDesc('a.id')
                ->get();

            DB::commit();      
            return response()->json(["status" => true, "data" => $data], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
      $data['title'] = 'Create Helpdesk';
      return view('helpdesk.add', $data);
    }

    public function detail_inbox() {
        $data['title'] = 'Create Helpdesk';
        return view('helpdesk.detail', $data);
    }

    public function look_helpdesk(Request $request) {
        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required|integer'
            ]);

            $id = $request->input('id');
      
            $sql = "
            SELECT 
            a.id, b.name AS subjek, c.name AS sender, a.message, a.reply_message, a.url, a.file_upload AS doc, d.nama AS destination, a.created_at
            FROM helpdesk_inbox AS a
            JOIN helpdesk_categories AS b ON a.cat_id = b.id
            JOIN users AS c ON a.user_id_sender = c.id
            JOIN level AS d ON a.level_id = d.id
            WHERE b.deleted = '0'
            AND a.id = :id
            ";
      
            $data = DB::select($sql, ['id' => $id]);
      
            DB::commit();
      
            return response()->json(["status" => true, "data" => $data], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
        }
    }

    public function reply_helpdesk(Request $request) {
        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required',
                'caption' => 'required'
            ]);

            $id = $request->input('id');
            $caption = $request->input('caption');
      
            $data = [
                'user_id_receiver' => auth()->user()->id,
                'reply_message' => $caption,
                'status' => '2'
            ];
      
            $action = DB::table('helpdesk_inbox')->where('id', $id)->update($data);
      
            DB::commit();
            if($action) {
                return response()->json(["status" => true, "message" => "Helpdesk has been replied"], 200);
            } else {
                return response()->json(["status" => false, "message" => "Helpdesk failure replied"], 400);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
        }
    }

    public function cat_helpdesk() {
        try {
            DB::beginTransaction();
      
            $sql = "
            SELECT a.id, a.name
            FROM helpdesk_categories AS a
            WHERE deleted = '0'
            ";
      
            $data = DB::select($sql);
      
            DB::commit();
      
            return response()->json(["status" => true, "data" => $data], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
          }
    }

    public function level() {
        try {
            DB::beginTransaction();
            
            $level = auth()->user()->level_id;

            $sql = "
            SELECT a.id, a.nama
            FROM level AS a
            WHERE deleted = '0'
            AND id != :level
            ";
      
            $data = DB::select($sql, ['level' => $level]);
      
            DB::commit();
      
            return response()->json(["status" => true, "data" => $data], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
          }
    }

    public function sending_helpdesk(Request $request) {
        try {
            DB::beginTransaction();
  
            $request->validate([
              'destination' => 'required|string',
              'problem' => 'required|string',
              'caption' => 'required|string',
            ]);
  
            $images = [];
            foreach (['upload_file'] as $key) {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $imageName = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/helpdesk'), $imageName);
                    $images[$key] = $imageName;
                } else {
                    $images[$key] = null;
                }
            }
  
            $data = [
              'level_id' => $request->input('destination'),
              'cat_id' => $request->input('problem'),
              'url' => $request->input('url_error'),
              'user_id_sender' => auth()->user()->id,
              'file_upload' => $images['upload_file'],
              'message' => $request->input('caption'),
              'status' => '0',
              'created_at' => now(),
            ];
            DB::table('helpdesk_inbox')->insert($data);
  
            DB::commit();
            return response()->json(["status" => true, "message" => "Helpdesk has been created"], 200);
  
        } catch (\Exception $e) {
            DB::rollBack();
  
            Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
                'exception' => $e,
            ]);
  
            return response()->json(['error' => 'An error occurred while processing the request.',
            'message' => $e->getMessage()], 500);
  
          }
      }

    public function download($filename) {
        $path = public_path('uploads/helpdesk/' . $filename);
  
          if (file_exists($path)) {
              return Response::download($path, $filename);
          } else {
              return redirect()->back()->with('error', 'File tidak ditemukan.');
          }
    }

    public function helpdesk_in() {
      try {
        DB::beginTransaction();
  
        $currentUserId = auth()->user()->id;
        $result = DB::table('helpdesk_inbox as a')
        ->join('users as c', 'a.user_id_sender', '=', 'c.id')
        ->select('a.id', 'c.name as sender', 'a.message', 'a.created_at')
        ->where('a.status', '!=', '2')
            ->where(function ($query) use ($currentUserId) {
                $query->where(function ($subQuery) use ($currentUserId) {
                    $subQuery->whereNotNull('a.user_id_receiver')
                             ->where('a.user_id_receiver', '=', $currentUserId);
                })->orWhere(function ($subQuery) {
                    $subQuery->whereNull('a.user_id_receiver')
                            ->where('a.level_id', '=', auth()->user()->level_id);
                    });
                })
        ->orderByDesc('a.id')
        ->get();

      $total = 0;
      foreach ($result as $key => $row) {
          $total += $row->id;
          $data[] = [
              'url' => url("Helpdesk/detail_inbox/{$row->id}"),
              'image' => 'https://static-00.iconduck.com/assets.00/user-icon-1024x1024-dtzturco.png',
              'name' => $row->sender,
              'helpdesk' => Str::limit($row->message, 40, '...'),
              'waktu' => Carbon::parse($row->created_at)->diffForHumans(),
        ];
      }
  
        DB::commit();
  
        return response()->json(['message' => "Data found", 'data' => $data, 'total' => $total], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
            'exception' => $e,
        ]);
        return response()->json(['error' => 'An error occurred while processing the request.',
        'message' => $e->getMessage()], 500);
      }
  }

  public function category() {
      $data['title'] = 'Helpdesk Category';
      return view('helpdesk.categori.index', $data);
  }

  public function insert_category(Request $request) {
    try {
        DB::beginTransaction();

        $request->validate([
            'category' => 'required|string'
        ]);

        $data = [
            'name' => $request->input('category'),
            'deleted' => '0',
            'created_by' => auth()->user()->id,
            'created_at' => now(),
        ];
  
        $action = DB::table('helpdesk_categories')->insert($data);
  
        DB::commit();

        if($action) {
            return response()->json(["status" => true, "message" => "Data has been inserted"], 200);
        } else {
            return response()->json(["status" => false, "message" => "Data has been inserted"], 400);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
            'exception' => $e,
        ]);
        return response()->json(['error' => 'An error occurred while processing the request.',
        'message' => $e->getMessage()], 500);
      }
  }

  public function data_category() {
    try {
        DB::beginTransaction();
  
        $sql = "
            SELECT id, name FROM helpdesk_categories WHERE deleted = '0' ORDER BY id DESC
        ";
        $data = DB::select($sql);
  
        DB::commit();
  
        return response()->json(['message' => "data found", 'data' => $data], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
            'exception' => $e,
        ]);
        return response()->json(['error' => 'An error occurred while processing the request.',
        'message' => $e->getMessage()], 500);
      }
  }

  public function detail_modal() {
    $data['title'] = 'Helpdesk Category';
    return view('helpdesk.categori.modal', $data);
  }

  public function det_cat(Request $request) {
    try {
        DB::beginTransaction();

        $request->validate([
            'id' => 'required|integer'
        ]);

        $id = $request->input('id');
        $sql = "
        SELECT id, name FROM helpdesk_categories WHERE deleted = '0' AND id = :id
        ";
        $data = DB::selectOne($sql, ['id' => $id]);
  
        DB::commit();

        return response()->json(["status" => true, "data" => $data], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
            'exception' => $e,
        ]);
        return response()->json(['error' => 'An error occurred while processing the request.',
        'message' => $e->getMessage()], 500);
      }
  }

  public function update_category(Request $request) {
    try {
        DB::beginTransaction();

        $request->validate([
            'id' => 'required|integer',
            'category' => 'required|string'
        ]);

        $id = $request->input('id');
  
        $data = [
            'name' => $request->input('category'),
            'updated_at' => now(),
        ];
        $action = DB::table('helpdesk_categories')->where('id', $id)->update($data);
  
        DB::commit();

        if($action) {
            return response()->json(["status" => true, 'message' => "Category has been updated"], 200);
        } else {
            return response()->json(["status" => false, 'message' => "Category failure updated"], 400);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in index method: ' . $e->getMessage().'-'.$e->getLine().'-'.$e->getFile(), [
            'exception' => $e,
        ]);
        return response()->json(['error' => 'An error occurred while processing the request.',
        'message' => $e->getMessage()], 500);
      }
  }


//   catatan : untuk import excel, contoh importnya ada di public/example-import-excel.xls
  public function import_excel(Request $request) {
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $data = Excel::toArray([], $request->file('file'));

    $rows = $data[0];
    foreach ($rows as $row) {
        DB::table('helpdesk_categories')->insert([
            'name'  => $row[0],
            'deleted' => $row[1],
            'created_by' => auth()->user()->id,
            'created_at' => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Data berhasil diimpor!');
  }

  public function export_excel()
    {
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        return Excel::download(new class($users) implements FromCollection {
            private $users;

            public function __construct($users)
            {
                $this->users = $users;
            }

            public function collection()
            {
                return $this->users;
            }
        }, 'users.xlsx');
    }
  
}
