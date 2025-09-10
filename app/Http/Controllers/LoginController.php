<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Walas;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\Siswa;

class LoginController extends Controller
{
    public function loginWalas(Request $request){
        $walas = Walas::where('nig', $request->txt_nig)->first();

        if(!$walas || !Hash::check($request->txt_pass,$walas->password)){
            return redirect()->back()->with('error','NIG Atau Password Salah!');
        }

        $kelas = Kelas::where('id',$walas->kelas_id)->first();

        session([
            'role' => 'Walas',
            'id' => $walas->id,
            'nig' => $walas->nig,
            'nama' => $walas->nama_walas,
            'kelas_id' => $kelas->id,
            'nama_kelas' => $kelas ? $kelas->nama_kelas : 'Kelas Tidak Ditemukan!',
        ]);
        return redirect('/nilai-raport/index');
    }    

    public function loginSiswa(Request $request){
        $siswa = Siswa::where('nis', $request->txt_nis)->first();

        if(!$siswa || !Hash::check($request->txt_pass,$siswa->password)){
            return redirect()->back()->with('error','NIG Atau Password Salah!');
        };

        $kelas = Kelas::where('id',$siswa->kelas_id)->first();

        session(
            [
                'role' => 'Murid',
                'id' => $siswa->id,
                'nig' => $siswa->nig,
                'nama' => $siswa->nama_siswa,
                'kelas_id' => $kelas->id,
                'nama_kelas' => $kelas ? $kelas->nama_kelas : 'Kelas Tidak Ditemukan',
            ]
        );
        return redirect('/nilai-raport/show');
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
