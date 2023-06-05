<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $datas = Jadwal::all();

        return view('home', compact('datas'));
    }

    public function tambah()
    {
        return view('simpan');
    }

    public function simpan(Request $req)
    {
        $jadwal = new Jadwal;
        $jadwal->tanggal    = $req->tanggal;
        $jadwal->jam        = $req->jam;
        $jadwal->kegiatan   = $req->kegiatan;
        $jadwal->save();

        return redirect('/tambah')->with('status', 'Data sukses ditambahkan');
    }
}
