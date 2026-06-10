<?php
include_once "../conexao/Conexao.php";

/* lógica de login */


if(!isset($_POST['EMAIL']) || !isset($_POST['password'])) {
    $stmt = $pdo->prepare("SELECT  FROM usuarios WHERE EMAIL = :EMAIL AND PASSWORD = :password");
    $stmt->execute(['EMAIL' => $_POST['EMAIL'], 'password' => $_POST['password']]);
    $tipo_usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($tipo_usuarios === 1) {
        header('Location: ../../view/painelContratado.php');
        exit;
    } else if($tipo_usuarios === 2) {
        header('Location: ../../view/painelContratante.php');
        exit;
    } else {
        echo "Credenciais inválidas.";
    }
    
}

/* lógica de criação de conta */