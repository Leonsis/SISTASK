<?php
require_once __DIR__ . '/../conexao/Conexao.php';

class loginController {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /* lógica de criar login */
    public function criarLoginAction($pDados) {
        
        try {
            
            $sql = "INSERT INTO USERS (NOME, PESSOA_FISICA_JURIDICA, CPF_CNPJ, PASSWORD, TELEFONE, EMAIL) 
                    VALUES (:NOME, :PESSOA_FISICA_JURIDICA, :CPF_CNPJ, :PASSWORD, :TELEFONE, :EMAIL)";
            $stmt = $this->pdo->prepare($sql);
            
            $dados = [
                ':NOME'                    => $pDados['NOME'],
                ':PESSOA_FISICA_JURIDICA'  => $pDados['PESSOA_FISICA_JURIDICA'],
                ':CPF_CNPJ'                => $pDados['CPF_CNPJ'],
                ':PASSWORD'                => $pDados['PASSWORD'],
                ':TELEFONE'                => $pDados['TELEFONE'],
                ':EMAIL'                   => $pDados['EMAIL'],
            ];

            if ($stmt->execute($dados)) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos com sucesso!']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao salvar os dados.']);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar os dados: ' . $e->getMessage()]);
        }
    }

}