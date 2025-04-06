<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadOffice;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

use App\Services\DivisionService;


use Exception;


class StrukturOrganisasiController extends Controller
{
    //

    public function __construct(
        protected DivisionService $divisionService
    ) {}

   
    public function index()
    {
       

        return view('menu.struktur-organisasi');

    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'division' => 'required|string',
            'ho_input_division' => 'required|string',
           
            'head_id' => 'required|string',
            
        ]);

          // Ambil nomor terakhir dengan tipe 'SOP'
            $lastDoc = HeadOffice::where('tipe', 'struktur_organisasi')->latest('id')->value('doc_number');

            // Generate nomor baru
            if ($lastDoc) {
                // Ambil angka terakhir dari format "SOP/HO-000X"
                preg_match('/(\d+)$/', $lastDoc, $matches);
                $nextNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
            } else {
                $nextNumber = 1;
            }

            
            $newDocNumber = 'SO/HO-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
            
            HeadOffice::create([
                'doc_number' => $newDocNumber,
               
                'division_id' => $request->division,
                'division_name' => $request->ho_input_division,
                'head_id' => $request->head_id,
                'tipe' => "struktur_organisasi",
                'file_path' => $path,
                'user_id' => Auth::user()->id,
            ]);

            return response()->json(['success' => true, 'message' => 'File berhasil diupload!', 'doc_number' => $newDocNumber]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengupload file!']);
    }

    public function headoffice(Request $request)
    {
              // $data = HeadOffice::select('doc_number', 'division_id', 'division_name', 'head_id', 'file_path','created_at');
              $data = HeadOffice::whereNull('deleted_at')->get(); // atau default pakai ->get() saja, Laravel exclude soft delete
       
        $divisionIds = $data->pluck('division_id')->filter()->unique()->toArray();
        $divisionHeads = [];
        foreach ($divisionIds as $divId) {
            $divisionHeads[$divId] = $this->divisionService->getHeadOfDivisionFullName($divId);
        }
        
        if ($request->ajax()) {
          
      
            // $data = HeadOffice::select('doc_number', 'division_id', 'division_name', 'head_id', 'file_path','created_at')->get();
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal_upload', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y') : '-';
                })
                ->addColumn('file_preview', function ($row) {
                    $fileUrl = asset('storage/' . $row->file_path);
                    return file_exists(public_path('storage/' . $row->file_path)) ? 
                        '<a href="' . $fileUrl . '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file "></a>' : 
                        '<span class="text-danger">File Not Found</span>';
                })
                ->addColumn('fullname', function ($row) use ($divisionHeads) {
                  
                    $divisionId = $row->division_id ?? null;

                    if (!$divisionId || !isset($divisionHeads[$divisionId])) {
                        logger()->info('Missing or invalid division_id in row', ['id' => $row->id, 'division_id' => $divisionId]);
                        return 'N/A';
                    }
                
                    return $divisionHeads[$divisionId];
                })
               
                ->addColumn('soft_delete', function ($row) {
                    return '<button class="btn btn-danger btn-sm delete-ho" data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>';
                })->rawColumns(['fullname','file_preview','soft_delete'] )
                ->make(true);
        } 
   
            return view('menu.struktur-organisasi', compact('data'));
        
        }

        public function softDelete($id)
            {
                $data = HeadOffice::findOrFail($id);
                $data->delete();
          
                return response()->json(['message' => 'Data berhasil dihapus ']);
            }


    public function restore($id){
            $data = HeadOffice::withTrashed()->findOrFail($id);
            $data->restore();

            return response()->json(['message' => 'Data berhasil direstore.']);
        }

    public function getDeleted(){
        $deleted = HeadOffice::onlyTrashed()->get();

        return response()->json($deleted);
    }
    }

