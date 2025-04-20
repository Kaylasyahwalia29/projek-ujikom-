<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'alamat'    => 'Jl. Terusan Cibaduyut No 148, Kab Bandung',
            'no_hp'     => '0895606982020',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'isAdmin'  => 1,
        ]);
        User::create([
            'name'     => 'keyla',
            'email'    => 'keyla@mail.test',
            'alamat'    => 'Jl. Terusan Cibaduyut No 148, Kab Bandung',
            'no_hp'     => '0895606982020',
            'password' => Hash::make('12345678'),
            'isAdmin'  => 2,
        ]);
    }
}
