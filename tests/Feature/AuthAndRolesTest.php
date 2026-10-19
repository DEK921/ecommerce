<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndRolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_invitado_ve_paginas_publicas(): void
    {
        foreach (['/', '/quienes-somos', '/mision-vision', '/ubicacion', '/contacto', '/login', '/registro'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_invitado_no_entra_a_dashboards(): void
    {
        $this->get('/cliente/dashboard')->assertRedirect('/login');
        $this->get('/gerente/dashboard')->assertRedirect('/login');
        $this->get('/usuarios')->assertRedirect('/login');
    }

    public function test_registro_valido_crea_cliente_y_redirige(): void
    {
        $response = $this->post('/registro', [
            'name' => 'María López',
            'email' => 'MARIA@correo.com',
            'phone' => '961 123 4567',
            'password' => 'Secreta123',
            'password_confirmation' => 'Secreta123',
            'terms' => '1',
        ]);

        $response->assertRedirect(route('cliente.dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'maria@correo.com', 'role' => 'cliente', 'phone' => '9611234567',
        ]);
    }

    public function test_registro_rechaza_datos_incorrectos(): void
    {
        User::factory()->create(['email' => 'repetido@correo.com']);

        $this->from('/registro')->post('/registro', [
            'name' => 'J4',
            'email' => 'repetido@correo.com',
            'phone' => '123',
            'password' => 'corta',
            'password_confirmation' => 'distinta',
        ])->assertRedirect('/registro')
          ->assertSessionHasErrors(['name', 'email', 'phone', 'password', 'terms']);

        $this->assertGuest();
    }

    public function test_login_redirige_segun_rol(): void
    {
        $roles = [
            'cliente' => 'cliente.dashboard',
            'empleado' => 'empleado.dashboard',
            'gerente' => 'gerente.dashboard',
        ];

        foreach ($roles as $role => $route) {
            $user = User::factory()->create(['role' => $role, 'password' => 'Password123']);

            $this->post('/login', ['email' => $user->email, 'password' => 'Password123'])
                ->assertRedirect(route($route));

            $this->get(route($route))->assertOk();
            $this->post('/logout')->assertRedirect('/');
            $this->assertGuest();
        }
    }

    public function test_login_con_contrasena_incorrecta_falla(): void
    {
        $user = User::factory()->create(['password' => 'Password123']);

        $this->post('/login', ['email' => $user->email, 'password' => 'otra'])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_cliente_no_puede_entrar_a_zona_de_gerente(): void
    {
        $cliente = User::factory()->create(['role' => 'cliente']);

        $this->actingAs($cliente)->get('/usuarios')->assertRedirect(route('cliente.dashboard'));
        $this->actingAs($cliente)->get('/gerente/dashboard')->assertRedirect(route('cliente.dashboard'));
    }

    public function test_gerente_hace_crud_de_usuarios(): void
    {
        $gerente = User::factory()->create(['role' => 'gerente']);
        $this->actingAs($gerente);

        // Listar
        $this->get('/usuarios')->assertOk()->assertSee($gerente->email);

        // Crear
        $this->post('/usuarios', [
            'name' => 'Pedro Ruiz', 'email' => 'pedro@correo.com', 'role' => 'empleado',
            'password' => 'Password123', 'password_confirmation' => 'Password123',
        ])->assertRedirect('/usuarios');
        $pedro = User::where('email', 'pedro@correo.com')->firstOrFail();
        $this->assertSame('empleado', $pedro->role);

        // Ver
        $this->get("/usuarios/{$pedro->id}")->assertOk()->assertSee('Pedro Ruiz');

        // Editar (sin cambiar contraseña)
        $this->put("/usuarios/{$pedro->id}", [
            'name' => 'Pedro Ruiz Gómez', 'email' => 'pedro@correo.com', 'role' => 'cliente',
        ])->assertRedirect('/usuarios');
        $this->assertDatabaseHas('users', ['id' => $pedro->id, 'name' => 'Pedro Ruiz Gómez', 'role' => 'cliente']);

        // Eliminar
        $this->delete("/usuarios/{$pedro->id}")->assertRedirect('/usuarios');
        $this->assertDatabaseMissing('users', ['id' => $pedro->id]);

        // No puede eliminarse a sí mismo
        $this->delete("/usuarios/{$gerente->id}");
        $this->assertDatabaseHas('users', ['id' => $gerente->id]);
    }
}
