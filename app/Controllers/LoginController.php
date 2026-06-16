<?php
require_once __DIR__ . '/../conexao/Conexao.php';
require_once __DIR__ . '/../Core/Controller.php';

class loginController extends Controller {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function viewLogin()
    {
        $this->view('login');
    }

    public function viewCriarConta()
    {
        $empresas = [];

        $this->view('criarConta', [
            'empresas' => $empresas
        ]);
    }

/*     public function criarContaAcntion()
    {
        $sql = "SELECT ID, NOME_FANTASIA FROM EMPRESA";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        require BASE_PATH . '/view/criarConta.php';
    } */
    
    /* lógica de criar login */
    public function criarLoginAction($pDados) {
        
        try {
            // Verifica se já foi registrado uma conta com o CPF/CNPJ
            $sql = "SELECT * FROM USERS WHERE CPF_CNPJ = :CPF_CNPJ";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':CPF_CNPJ' => $pDados['CPF_CNPJ']
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'CPF/CNPJ já cadastrado']);
                exit;
            }

            $sql2 = "INSERT INTO USERS (NOME, PESSOA_FISICA_JURIDICA, CPF_CNPJ, PASSWORD, TELEFONE, EMAIL) 
                    VALUES (:NOME, :PESSOA_FISICA_JURIDICA, :CPF_CNPJ, :PASSWORD, :TELEFONE, :EMAIL)";
            $stmt = $this->pdo->prepare($sql2);
            
            // Gera o hash da senha
            $hash = password_hash($pDados['PASSWORD'], PASSWORD_DEFAULT); 
            $dados = [
                ':NOME'                    => $pDados['NOME'],
                ':PESSOA_FISICA_JURIDICA'  => $pDados['PESSOA_FISICA_JURIDICA'],
                ':CPF_CNPJ'                => $pDados['CPF_CNPJ'],
                ':PASSWORD'                => $hash,
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

    /* lógica de login */
    public function loginAction($pDados) {
    
        try {
            
            $sql = "SELECT * FROM USERS WHERE CPF_CNPJ = :CPF_CNPJ AND PASSWORD = :PASSWORD";
            $stmt = $this->pdo->prepare($sql);
            
            $dados = [
                ':CPF_CNPJ' => $pDados['CPF_CNPJ'],
                ':PASSWORD' => $pDados['PASSWORD'],
            ];

            if ($stmt->execute($dados)) {
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Login realizado con sucesso!']);
            } else {
                echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao logar.']);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao ao logar: ' . $e->getMessage()]);
        }
    }

}