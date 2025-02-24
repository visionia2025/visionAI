<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'before_or_equal' =>'El usuario debe tener minimo 18 años.',
    'unique' =>'El :attribute ya se encuentra asociado a otro registro.',
    'exists'=>'El :attribute no existe en el sistema.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'birthdate' => 'fecha de nacimiento',
        'password' => 'contraseña',
    ],

];
