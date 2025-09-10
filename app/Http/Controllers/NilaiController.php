<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Walas;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Siswa;

class NilaiController extends Controller
{
    public function index(){
        $walas = Walas::find(session('id'));
        if(!$walas){
            return back()->with('error', 'Wali Kelas Tidak Di Temukan');
        }
        $data_nilai = Nilai::whereHas('siswa',function($query) use ($walas){
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();
        $kelas = Kelas::where('id', session('id'))->first();
        return view('nilai.index',compact(['data_nilai','kelas']));
    }

    public function create(){
        $walas = Walas::find(session('id'));
        $nilai = Nilai::pluck('siswa_id');

        $siswa = Siswa::where('kelas_id', $walas->kelas_id)->whereNotIn('id',$nilai)->get();
        return view('nilai.create',['siswa' => $siswa]);
    }

    public function store(Request $request){
        $data_nilai = $request->validate(
            [
                'siswa_id' => ['required'],
                'matematika' => ['required','numeric','between:0,100'],
                'indonesia' => ['required','numeric','between:0,100'],
                'inggris' => ['required','numeric','between:0,100'],
                'kejuruan' => ['required','numeric','between:0,100'],
                'pilihan' => ['required','numeric','between:0,100'],
            ],
        );
        if(!$data_nilai){
            return back()->with('error', 'Nilai harus antara 0 sampai 100');
        }

        $data_nilai['walas_id'] = session('id');
        $data_nilai['siswa_id'] = $request->siswa_id;
        $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris'] +
            $data_nilai['kejuruan'] +
            $data_nilai['pilihan']
        )/5
    );

    $cek_nilai = Nilai::where('siswa_id', $request->siswa_id)->first();

    if($cek_nilai){
        return back()->with('error','Nilai Siswa Sudah Ada');
    }else{
        Nilai::create($data_nilai);
        return redirect('/nilai-raport/index')->with('success','Data Berhasil Di Tambahkan');
    }
    }

    public function edit(Nilai $nilai){
        $walas = Walas::find(session('id'));
        $siswa = Siswa::where('id',$nilai->siswa_id)->first();
        return view('nilai.edit',[
            'nilai' => $nilai,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, Nilai $nilai){
        $data_nilai = $request->validate([
            'siswa_id' => ['required'],
            'matematika' => ['required','numeric','between:0,100'],
            'indonesia' => ['required','numeric','between:0,100'],
            'inggris' => ['required','numeric','between:0,100'],
            'kejuruan' => ['required','numeric','between:0,100'],
            'pilihan' => ['required','numeric','between:0,100'],
        ]);
        $data_nilai['walas_id'] = session('id');
        $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris']+
            $data_nilai['kejuruan']+
            $data_nilai['pilihan']
         )/5);
         if(!$data_nilai){
            return back()->with('error','Nilai harus antara 0 sampai 100');
         }
         $nilai->update($data_nilai);
         return redirect('/nilai-raport/index')->with('success','Data Nilai Berhasil Di Update');
    }

    public function destroy(Nilai $nilai){
        $nilai->delete();
        return redirect('/nilai-raport/index')->with('success','Data Nilai Berhasil Di Hapus');
    }

    public function gradeMapel($nilai){
        if($nilai>=90){
            return 'A';
        }elseif($nilai>=80){
            return 'B';
        }elseif($nilai>=70){
            return 'C';
        }elseif($nilai>=60){
            return 'D';
        }else{
            return 'E';
        }
    }

    public function show(){
        $siswa = Siswa::with(['kelas','nilai'])->find(session('id'));
        $nilai = optional($siswa->nilai)->first();
        $walas = Walas::where('kelas_id',$siswa->kelas->id)->first();

        $data_nilai = [
                'matematika' => [
                    'nilai' => $nilai->matematika ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->matematika) : 'N/A'
                ],
                'indonesia' => [
                    'nilai' => $nilai->indonesia ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->indonesia) : 'N/A'
                ],
                'inggris' => [
                    'nilai' => $nilai->inggris ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->inggris) : 'N/A'
                ],
                'kejuruan' => [
                    'nilai' => $nilai->kejuruan ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->kejuruan) : 'N/A'
                ],
                'pilihan' => [
                    'nilai' => $nilai->pilihan ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->pilihan) : 'N/A'
                ],
                'rata_rata' => [
                    'nilai' => $nilai->rata_rata ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->rata_rata) : 'N/A'
                ]
        ];

        return view('nilai.show',[
            'siswa' => $siswa,
            'data_nilai' => $data_nilai,
            'walas' => $walas,
        ]);
    }

    public function showNilai($id){
        $siswa = Siswa::with(['las','nilai'])->find(session('id'));
        $nilai = optional($siswa->nilai)->first();
        $walas = Walas::where('kelas_id',$siswa->kelas->id)->first();

        $data_nilai = [
                'matematika' => [
                    'nilai' => $nilai->matematika ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->matematika) : 'N/A'
                ],
                'indonesia' => [
                    'nilai' => $nilai->indonesia ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->indonesia) : 'N/A'
                ],
                'inggris' => [
                    'nilai' => $nilai->inggris ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->inggris) : 'N/A'
                ],
                'kejuruan' => [
                    'nilai' => $nilai->kejuruan ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->kejuruan) : 'N/A'
                ],
                'pilihan' => [
                    'nilai' => $nilai->pilihan ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->pilihan) : 'N/A'
                ],
                'rata_rata' => [
                    'nilai' => $nilai->rata_rata ?? 'Data Tidak Tersedia',
                    'grade' => $nilai ? $this-> gradeMapel($nilai->rata_rata) : 'N/A'
                ]
        ];

        return view('nilai.show',[
            'siswa' => $siswa,
            'data_nilai' => $data_nilai,
            'walas' => $walas,
        ]);
    }
}
