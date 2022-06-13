<?php

return [

  'use_morph_map' => false,

  'checker' => 'default',

  'cache' => [

    'enabled' => env('LARATRUST_ENABLE_CACHE', env('APP_ENV') === 'production'),

    'expiration_time' => 3600,
  ],

  'user_models' => [
    'users' => \App\Models\User::class,
  ],

  'models' => [

    'role' => \App\Models\Role::class,

    'permission' => \App\Models\Permission::class,

    'team' => \App\Models\Team::class,
  ],

  'tables' => [

    'roles' => 'roles',

    'permissions' => 'permissions',

    'teams' => 'teams',

    'role_user' => 'role_user',

    'permission_user' => 'permission_user',

    'permission_role' => 'permission_role',
  ],

  'foreign_keys' => [

    'user' => 'user_id',

    'role' => 'role_id',

    'permission' => 'permission_id',

    'team' => 'team_id',
  ],

  'middleware' => [
    'register' => true,

    'handling' => 'abort',

    'handlers' => [
      'abort' => [
        'code' => 403,
        'message' => 'User does not have any of the necessary access rights.'
      ],

      'redirect' => [
        'url' => '/home',
        'message' => [
          'key' => 'error',
          'content' => ''
        ]
      ]
    ]
  ],

  'teams' => [
    'enabled' => false,

    'strict_check' => false,
  ],

  'magic_is_able_to_method_case' => 'kebab_case',

  'permissions_as_gates' => false,

  'panel' => [
    'register' => false,

    'path' => 'laratrust',

    'go_back_route' => '/',

    'middleware' => ['web'],

    'assign_permissions_to_user' => true,

    'create_permissions' => true,

    'roles_restrictions' => [
      'not_removable' => [],

      'not_editable' => [],

      'not_deletable' => [],
    ],
  ]
];
