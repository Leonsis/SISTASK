<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/app/controllers/loginController.php';

$controller = new loginController();

$acao = isset($_POST['TIPO_FORM']);

switch ($acao) {
    case '1':
        $controller->criarLoginAction($_POST);
        break;

    default:
        echo json_encode(['status' => 'erro', 'mensagem' => 'Ação não encontrada']);
        break;
}
