<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all()->sortBy("jam");

        $today = Carbon::today();
        $date = Carbon::parse($today)->translatedFormat('l, j F Y');
        $jadwal_now = [];
        $jadwal_besok = [];
        foreach ($jadwal as $jad) {
            if (Carbon::today()->toDateString() == $jad->tanggal) {
                $jad->jam = date('H:i', strtotime($jad->jam));
                $jadwal_now[] = $jad;
            } else if (Carbon::tomorrow()->toDateString() == $jad->tanggal) {
                $jad->jam = date('H:i', strtotime($jad->jam));
                $jadwal_besok[] = $jad;
            }
        }

        return view('dashboard', compact('date', 'jadwal_now', 'jadwal_besok'));
    }

    public function download($id)
    {
        $path = storage_path('app/public/files/' . $id);
        return response()->download($path);
    }
}
