<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // Niveles de acceso disponibles
    public const ROLE_CLIENTE  = 'cliente';
    public const ROLE_EMPLEADO = 'empleado';
    public const ROLE_GERENTE  = 'gerente';

    public const ROLES = [
        self::ROLE_CLIENTE  => 'Cliente',
        self::ROLE_EMPLEADO => 'Empleado',
        self::ROLE_GERENTE  => 'Gerente',
    ];

    protected $fillable = [
        'name',
        'email',
        'role',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public function isCliente(): bool
    {
        return $this->role === self::ROLE_CLIENTE;
    }

    public function isEmpleado(): bool
    {
        return $this->role === self::ROLE_EMPLEADO;
    }

    public function isGerente(): bool
    {
        return $this->role === self::ROLE_GERENTE;
    }

    /** Nombre legible del rol, p. ej. "Gerente". */
    public function getRoleNameAttribute(): string
    {
        return self::ROLES[$this->role] ?? ucfirst((string) $this->role);
    }

    /** Ruta del dashboard que le corresponde a este usuario según su rol. */
    public function dashboardRoute(): string
    {
        return match ($this->role) {
            self::ROLE_GERENTE  => 'gerente.dashboard',
            self::ROLE_EMPLEADO => 'empleado.dashboard',
            default             => 'cliente.dashboard',
        };
    }
}
