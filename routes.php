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

    '/autenticar-Action' => [
        'controller' => 'LoginController',
        'method' => 'autenticarAction'
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

    '/logout-action' => [
        'controller' => 'PainelController',
        'method' => 'logoutAction'
    ],

    '/criar-task-action' => [
        'controller' => 'TasksController',
        'method' => 'criarTaskAction'
    ],

    '/deletar-task-action' => [
        'controller' => 'TasksController',
        'method' => 'deletarTaskAction'
    ],

    '/task' => [
        'controller' => 'TasksController',
        'method' => 'viewTask'
    ],

];