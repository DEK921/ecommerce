<?php

// Mensajes de validación en español (los que usa este proyecto).
return [
    'accepted'  => 'Debes aceptar :attribute.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'digits'    => ':attribute debe tener :digits dígitos.',
    'email'     => ':attribute debe ser un correo electrónico válido.',
    'in'        => 'El valor seleccionado en :attribute no es válido.',
    'max'       => [
        'string' => ':attribute no puede tener más de :max caracteres.',
    ],
    'min'       => [
        'string' => ':attribute debe tener al menos :min caracteres.',
    ],
    'regex'     => 'El formato de :attribute no es válido.',
    'required'  => ':attribute es obligatorio.',
    'string'    => ':attribute debe ser texto.',
    'unique'    => 'Ya existe un registro con ese :attribute.',

    'password' => [
        'letters'       => 'La contraseña debe incluir al menos una letra.',
        'mixed'         => 'La contraseña debe incluir mayúsculas y minúsculas.',
        'numbers'       => 'La contraseña debe incluir al menos un número.',
        'symbols'       => 'La contraseña debe incluir al menos un símbolo.',
        'uncompromised' => 'Esta contraseña apareció en una filtración de datos. Elige otra.',
    ],

    'attributes' => [
        'name'     => 'el nombre',
        'email'    => 'el correo electrónico',
        'phone'    => 'el teléfono',
        'role'     => 'el rol',
        'password' => 'la contraseña',
        'terms'    => 'los términos y condiciones',
    ],
];
