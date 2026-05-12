<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar un usuario administrador en la tabla 'usuarios'
            DB::table('usuarios')->insert([
            'nombre' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            // El campo 'rol' se establece como 'A' para indicar que es un administrador
            'rol' => 'A',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
