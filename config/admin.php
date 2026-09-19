<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Administrator bootstrap account
    |--------------------------------------------------------------------------
    |
    | The initial password is used only when the administrator account does
    | not exist yet. It is never used to overwrite an existing password.
    |
    */
    'email' => env('ADMIN_EMAIL', 'adminsman2balige@gmail.com'),
    'name' => env('ADMIN_NAME', 'Admin Utama'),
    'initial_password' => env('ADMIN_INITIAL_PASSWORD', 'Sman2Balige!2026'),
];
