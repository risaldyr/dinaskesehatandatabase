<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('123123'),
            'nama' => 'Admin Absensi Internship',
            'jenis_kelamin' => 'pria',
            'alamat' => 'Dinas Kesehatan',
            'no_telepon' => '123123',
            'tgl_lahir' => '03 April 2020',
            'instansi' => 'Dinas Kesehatan',
            'role' => 'admin',
            'nama_mentor' => '-',
        ]);

        User::create([
            'username' => 'host',
            'password' => Hash::make('123123'),
            'nama' => 'Host Absensi Internship',
            'jenis_kelamin' => 'pria',
            'alamat' => 'Dinas Kesehatan',
            'no_telepon' => '123123',
            'tgl_lahir' => '03 April 2020',
            'instansi' => 'Dinas Kesehatan',
            'role' => 'host',
            'nama_mentor' => '-',
        ]);

        User::create([
            'username' => 'user',
            'password' => Hash::make('123123'),
            'nama' => 'Host Absensi Internship',
            'jenis_kelamin' => 'pria',
            'alamat' => 'Dinas Kesehatan',
            'no_telepon' => '123123',
            'tgl_lahir' => '03 April 2020',
            'instansi' => 'Dinas Kesehatan',
            'role' => 'user',
            'nama_mentor' => '-',
        ]);
    }
}
