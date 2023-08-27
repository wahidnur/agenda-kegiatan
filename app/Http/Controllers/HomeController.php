<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $datas = Jadwal::orderBy('created_at', 'asc')->paginate(3);
        if (request()->ajax()) {
            $datas = Jadwal::query();
            return DataTables::of($datas)->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $aksi = '<button type="button" class="btn btn-sm btn-primary" onclick="editData(' . $row->id . ')" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Edit</button>&nbsp;<button class="btn btn-sm btn-danger" id="hapus" onclick="hapusData(' . $row->id . ')">Hapus</button>';

                    return $aksi;
                })->rawColumns(['aksi'])
                ->make(true);
        }

        return view('home');
    }

    public function simpan(Request $req)
    {
        $attributes = [
            'tanggal'   => 'Tanggal',
            'kegiatan'  => 'Kegiatan',
            'jam'       => 'Jam',
            'lokasi'    => 'Lokasi',
            'berkas'    => 'Berkas'
        ];

        $msg = [
            'required' => ':attribute harus diisi.',
            'file'     => ':attribute harus file.',
            'mimes'    => ':attribute harus benar.'
        ];

        $validator = Validator::make($req->all(), [
            'tanggal'   => 'required',
            'kegiatan'  => 'required',
            'jam'       => 'required',
            'lokasi'    => 'required',
            'berkas'    => 'file|mimes:csv,doc,docx,ppt,pptx,xlx,xls,pdf,rar,zip'
        ], $msg, $attributes);
        // $this->validate($req, [
        //     'file'  => 'required|file|mimes:csv,doc,docx,ppt,pptx,xlx,xls,pdf,rar,zip'
        // ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()]);
        }

        $jadwal = new Jadwal;
        $jadwal->tanggal    = $req->tanggal;
        $jadwal->kegiatan   = $req->kegiatan;
        $jadwal->jam        = $req->jam;
        $jadwal->lokasi     = $req->lokasi;
        if ($req->file('berkas') != null) {
            $file = $req->file('berkas');
            $nama_file = date('H-i-s') . '_' . $file->getClientOriginalName();
            // $file->store('public'); perubahan nama acak
            // Storage::putFile('/public', $nama_file); gagal terus
            $file->storeAs('files', $nama_file, 'public');
            $jadwal->berkas     = $nama_file;
        }
        $jadwal->save();

        return response()->json(['success' => 'Sukses ditambahkan']);
    }

    public function edit($id)
    {
        $data = Jadwal::where('id', $id)->first();

        return response()->json(['data', $data]);
    }

    public function update($id, Request $req)
    {
        $attributes = [
            'tanggals'   => 'Tanggal',
            'kegiatans'  => 'Kegiatan',
            'jams'       => 'Jam',
            'lokasis'    => 'Lokasi',
            'berkass'    => 'Berkas'
        ];

        $msg = [
            'required' => ':attribute harus diisi.',
            'file'     => ':attribute harus file.',
            'mimes'    => ':attribute harus benar.'
        ];

        $validator = Validator::make($req->all(), [
            'tanggals'   => 'required',
            'kegiatans'  => 'required',
            'jams'       => 'required',
            'lokasis'    => 'required',
            'berkass'    => 'file|mimes:csv,doc,docx,ppt,pptx,xlx,xls,pdf,rar,zip'
        ], $msg, $attributes);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()]);
        }

        $data = Jadwal::findOrFail($id);
        $data->tanggal  = $req->tanggals;
        $data->kegiatan = $req->kegiatans;
        $data->jam      = $req->jams;
        $data->lokasi   = $req->lokasis;
        if ($req->berkass != null) {
            if ($data->berkas != null) {
                $path = storage_path('app/public/files/' . $data->berkas);
                unlink($path);
                $file = $req->file('berkass');
                $nama_file = date('H-i-s') . '_' . $file->getClientOriginalName();
                $file->storeAs('files', $nama_file, 'public');
                $data->berkas     = $nama_file;
            } else {
                $file = $req->file('berkass');
                $nama_file = date('H-i-s') . '_' . $file->getClientOriginalName();
                $file->storeAs('files', $nama_file, 'public');
                $data->berkas     = $nama_file;
            }
        }
        $data->update();
        return response()->json(['success' => 'Data berhasil diupdate']);
    }

    public function delete($id)
    {
        $data = Jadwal::findOrFail($id);
        $file = $data->berkas;
        $path = storage_path('app/public/files/' . $file);
        unlink($path);
        $data->delete();

        return response()->json(['success', 'Data dihapus.']);
    }
}
