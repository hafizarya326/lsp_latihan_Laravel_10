<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nis' => '1221001',
                'nama_siswa' => 'Rai',
                'kelas_id' => 1,
                'password' =>bcrypt('1234'),
            ],
            [
                'nis' => '1221002',
                'nama_siswa' => 'Rey',
                'kelas_id' => 1,
                'password' => bcrypt('1234'),
            ],
            [
                'nis' => '1221003',
                'nama_siswa' => 'Rei',
                'kelas_id' => 1,
                'password' => bcrypt('1234'),
            ],
            [
                'nis' => '1221004',
                'nama_siswa' => 'Riska',
                'kelas_id' => 2,
                'password' => bcrypt('1234'),
            ],
            [
                'nis' => '1221005',
                'nama_siswa' => 'Rina',
                'kelas_id' => 2,
                'password' => bcrypt('1234'),
            ],
            [
                'nis' => '1221006',
                'nama_siswa' => 'Ranu',
                'kelas_id' => 2,
                'password' => bcrypt('1234'),
            ],
        ];

        foreach($data as $siswa){
        Siswa::create($siswa);
        }
    }
}
