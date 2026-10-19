<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Crea un usuario de cada rol para probar los dashboards,
     * más algunos clientes de ejemplo para la lista de usuarios.
     * Contraseña de todos: Password123
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'gerente@mercadonova.mx'], [
            'name' => 'Laura Gerente', 'role' => User::ROLE_GERENTE,
            'phone' => '9611000001', 'password' => 'Password123',
        ]);

        User::updateOrCreate(['email' => 'empleado@mercadonova.mx'], [
            'name' => 'Carlos Empleado', 'role' => User::ROLE_EMPLEADO,
            'phone' => '9611000002', 'password' => 'Password123',
        ]);

        User::updateOrCreate(['email' => 'cliente@mercadonova.mx'], [
            'name' => 'Ana Cliente', 'role' => User::ROLE_CLIENTE,
            'phone' => '9611000003', 'password' => 'Password123',
        ]);

        User::factory(12)->create();
    }
}
