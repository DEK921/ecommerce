<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Validación para crear y editar usuarios desde el panel del Gerente.
 */
class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isGerente() ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'  => trim((string) $this->name),
            'email' => strtolower(trim((string) $this->email)),
            'phone' => $this->phone ? preg_replace('/\D/', '', $this->phone) : null,
        ]);
    }

    public function rules(): array
    {
        // En edición, el usuario actual llega por la ruta: /usuarios/{usuario}
        $user = $this->route('usuario');
        $isUpdate = $user instanceof User;

        return [
            'name'     => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s]+$/u'],
            'email'    => [
                'required', 'string', 'email', 'max:150',
                Rule::unique('users', 'email')->ignore($isUpdate ? $user->id : null),
            ],
            'phone'    => ['nullable', 'digits:10'],
            'role'     => ['required', Rule::in(array_keys(User::ROLES))],
            // Al editar, la contraseña es opcional (vacía = no se cambia)
            'password' => [
                $isUpdate ? 'nullable' : 'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex'         => 'El nombre solo puede contener letras y espacios.',
            'email.unique'       => 'Ya existe una cuenta con este correo.',
            'phone.digits'       => 'El teléfono debe tener exactamente 10 dígitos.',
            'role.in'            => 'Selecciona un rol válido.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
