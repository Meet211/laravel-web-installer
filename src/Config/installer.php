<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.2'
    ],

    'requirements' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'fileinfo',
        'curl'
    ],

    /*
    |--------------------------------------------------------------------------
    | Super Admin Step - Dynamic Fields
    |--------------------------------------------------------------------------
    |
    | Configure the fields to collect for the Super Admin user during install.
    | Each field can define: label, name, type, placeholder, rules, and default.
    |
    */
    'super_admin' => [
        'fields' => [
            [
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
                'placeholder' => 'Admin name',
                'rules' => 'required|string|max:255',
                'default' => ''
            ],
            [
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'admin@example.com',
                'rules' => 'required|email|max:255',
                'default' => ''
            ],
            [
                'label' => 'Password',
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Secure password',
                'rules' => 'required|string|min:8',
                'default' => ''
            ],
            [
                'label' => 'Mobile',
                'name' => 'mobile',
                'type' => 'text',
                'placeholder' => 'Contact number',
                'rules' => 'nullable|string|max:20',
                'default' => ''
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/app/'           => '775',
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775'
    ]
];
