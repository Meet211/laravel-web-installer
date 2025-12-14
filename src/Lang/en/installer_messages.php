<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'Laravel Installer',
    'tagline' => 'Web-Based Setup & Application Installer',
    'next' => 'Next Step',
    'finish' => 'Install',


    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'title'   => 'Welcome to the Installer',
        'message' => 'Let’s set up your Laravel application.',
    ],

    /**
     *
     * Step labels used in the sidebar wizard.
     *
     */
    'steps' => [
        'welcome' => [
            'title' => 'Welcome',
            'subtitle' => 'Start installation',
        ],
        'environment' => [
            'title' => 'Environment',
            'subtitle' => 'Configure database',
        ],
        'superAdmin' => [
            'title' => 'Admin User',
            'subtitle' => 'Create super admin',
        ],
        'requirements' => [
            'title' => 'Requirements',
            'subtitle' => 'Check PHP extensions',
        ],
        'permissions' => [
            'title' => 'Permissions',
            'subtitle' => 'Folder permissions',
        ],
        'final' => [
            'title' => 'Finish',
            'subtitle' => 'Complete setup',
        ],
    ],


    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'title' => 'Requirements',
        'php' => 'PHP Version >= :min',
        'ok' => 'OK',
        'missing' => 'Missing',
        'enabled' => 'Enabled',
    ],


    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'title' => 'Permissions',
        'ok' => 'OK',
        'fix' => 'Fix',
        'fix_issues' => 'Please fix the issues below and then click :action',
    ],


    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'title' => 'Environment Settings',
        'save' => 'Save .env',
        'success' => 'Your .env file settings have been saved.',
        'errors' => 'Unable to save the .env file, Please create it manually.',
        'fields' => [
            'hostname' => [
                'label' => 'Hostname',
                'placeholder' => '127.0.0.1',
            ],
            'username' => [
                'label' => 'Username',
                'placeholder' => '',
            ],
            'password' => [
                'label' => 'Password',
                'placeholder' => '',
            ],
            'database' => [
                'label' => 'Database',
                'placeholder' => '',
            ],
        ],
    ],

    'install' => 'Install',


    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Finished',
        'heading' => 'Installation Finished',
        'helper' => 'Here are the details you provided for the Super Admin:',
        'finished' => 'Application has been successfully installed.',
        'exit' => 'Click here to exit',
    ],
    'checkPermissionAgain' => ' Check Permission Again',


];
