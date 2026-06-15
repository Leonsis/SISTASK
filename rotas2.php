<?php
//header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/app/controllers/loginController.php';
require_once __DIR__ . '/app/controllers/empresaController.php';

$loginController = new loginController();
$empresaController = new empresaController();

define('BASE_PATH', __DIR__);

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : ' ';
switch ($pagina) {
    
    case 'criarConta':
        $loginController->criarContaAcntion();
        break;

    default:
        require 'app/view/home.php';
        break;
}

$acao = isset($_POST['TIPO_FORM']) ? $_POST['TIPO_FORM'] : ' ';
switch ($acao) {

    case '0':
        $loginController->loginAction($_POST);
        break;
    
    case '1':
        $loginController->criarLoginAction($_POST);
        break;
    
    case '2':
        $empresaController->cadastrarEmpresa($_POST);
        break;

    default:
        echo json_encode(['status' => 'erro', 'mensagem' => 'Ação não encontrada']);
        break;
}
