<?php

return [
    '/' => [
        'controller' => 'LoginController',
        'method' => 'viewLogin'
    ],

    '/criar-conta' => [
        'controller' => 'LoginController',
        'method' => 'viewCriarConta'
    ],
    
    '/criar-login-action' => [
        'controller' => 'LoginController',
        'method' => 'criarLoginAction'
    ],

    '/login-action' => [
        'controller' => 'LoginController',
        'method' => 'loginAction'
    ],

    '/cadastro-empresa' => [
        'controller' => 'EmpresaController',
        'method' => 'viewCadastroEmp'
    ],

    '/cadastrar-empresa-action' => [
        'controller' => 'EmpresaController',
        'method' => 'cadastrarEmpresaAction'
    ],

    '/painel' => [
        'controller' => 'PainelController',
        'method' => 'viewPainel'
    ],

];