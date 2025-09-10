<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Walas;

class WalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nig' => '4001001',
                'nama_walas' => 'Arah',
                'kelas_id' => 1,
                'password' => bcrypt('1234'),
            ],
            [
                'nig' => '4001002',
                'nama_walas'=> 'Java',
                'kelas_id' => 2,
                'password' => bcrypt('1234'),
            ],
        ];

        foreach($data as $walas){
        Walas::create($walas);
        }
    }
}
