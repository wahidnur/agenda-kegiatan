<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();

        $today = Carbon::today();
        $date = Carbon::parse($today)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y');
        $jadwal_now = [];
        $jadwal_besok = [];
        foreach ($jadwal as $jad) {
            if (Carbon::today()->toDateString() == $jad->tanggal) {
                $jadwal_now[] = $jad;
            } else if (Carbon::tomorrow()->toDateString() == $jad->tanggal) {
                $jad->jam = date('H:i', strtotime($jad->jam));
                $jadwal_besok[] = $jad;
            }
        }

        return view('dashboard', compact('date', 'jadwal_now', 'jadwal_besok', 'jadwal'));
    }
}
