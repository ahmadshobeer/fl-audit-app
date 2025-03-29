<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadOffice;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class StrukturOrganisasiController extends Controller
{
    //

   
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
        if ($request->ajax()) {
            $data = HeadOffice::select('doc_number', 'division_id', 'division_name', 'head_id', 'file_path', 'tipe', 'sop_id', 'user_id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal_upload', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y') : '-';
                })
                /* ->addColumn('file_preview', function ($row) {
                    return '<a href="'.asset('storage/'.$row->file_path).'" target="_blank" class="btn btn-sm btn-infp"><i class="fa fa-file text-white"></a>';
                })
                
                ->rawColumns(['file_preview'])
                ->addColumn('soft_delete', function ($row) {
                    return '<a href="'.asset('storage/'.$row->file_path).'" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-delete"></i></a>';
                }) */
                ->make(true);
        }
            // return DataTables::of($data)->make(true);
            return view('menu.struktur-organisasi');
        }
    }

