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

    '/cadastro-empresa' => [
        'controller' => 'EmpresaController',
        'method' => 'viewCadastroEmp'
    ],

    '/cadastrar-empresa-action' => [
        'controller' => 'EmpresaController',
        'method' => 'cadastrarEmpresaAction'
    ],


];