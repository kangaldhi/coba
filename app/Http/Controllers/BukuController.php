<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $data = Buku::get();

        return view('buku.index', compact('data'));
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Buku::get();
    //         return DataTables::of($data)->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $btn = '<a href="'.route('admin.buku.edit', $row->id).'" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>';

    //                 $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm  tombol-delete"  data-toggle="tooltip" data-placement="top">Hapus</a>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('buku.index');
    // }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_buku' => 'required',
            'deskripsi_buku' => 'required',
        ]);

        Buku::create([
            'nama_buku' => $request->nama_buku,
            'deskripsi' => $request->deskripsi_buku,
        ]);

        return redirect()->route('admin.buku.index');
    }

    public function edit($id)
    {
        $data = Buku::findOrFail($id);

        return view('buku.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Buku::findOrFail($id);

        $request->validate([
            'nama_buku' => 'required',
            'deskripsi_buku' => 'required',
        ]);

        $data->update([
            'nama_buku' => $request->nama_buku,
            'deskripsi' => $request->deskripsi_buku,
        ]);

        return redirect()->route('admin.buku.index');
    }

    public function destroy($id)
    {
        $data = Buku::findOrFail($id)->delete();

        // return response()->json(['sukses' => 'Data berhasil dihapus!']);
        return redirect()->back()->with(['jenis' => 'success', 'pesan' => 'Berhasil menghapus data.']);
    }
}
