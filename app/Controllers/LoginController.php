<?php
require_once __DIR__ . '/../Core/Controller.php';

class LoginController extends Controller {

    private $pdo;

    public function __construct() {
        // global $pdo;
        require_once __DIR__ . '/../conexao/Conexao.php';
        $this->pdo = $pdo;
    }

    public function viewLogin()
    {
        $this->view('login');
    }

    public function viewCriarConta()
    {
        $empresas = [];

        $sql = "SELECT ID, NOME_FANTASIA FROM EMPRESA";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        $this->view('criarConta', [
            'empresas' => $empresas
        ]);
    }
    
    /* lógica de criar login */
    public function criarLoginAction() 
    {
        $pDados = isset($_POST) ? $_POST : [];
    
        try {
            $pDados['CPF'] = preg_replace('/\D/', '', $pDados['CPF']);

            // Verifica se já foi registrado uma conta com o CPF/CNPJ
            $sql = "SELECT * FROM USERS WHERE CPF = :CPF";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':CPF' => $pDados['CPF']
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'CPF já cadastrado']);
                exit;
            }

            $sql2 = "INSERT INTO USERS (NOME, EMPRESA_ID, CPF, PASSWORD, TELEFONE, EMAIL) 
                    VALUES (:NOME, :EMPRESA, :CPF, :PASSWORD, :TELEFONE, :EMAIL)";
            $stmt = $this->pdo->prepare($sql2);
            
            // Gera o hash da senha
            $hash = password_hash($pDados['PASSWORD'], PASSWORD_DEFAULT); 
            $dados = [
                ':NOME'                   => $pDados['NOME'],
                ':EMPRESA'                => $pDados['EMPRESA'],
                ':CPF'                    => $pDados['CPF'],                
                ':PASSWORD'               => $hash,
                ':TELEFONE'               => $pDados['TELEFONE'],
                ':EMAIL'                  => $pDados['EMAIL'],
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
    public function loginAction() {
        $pDados = isset($_POST) ? $_POST : [];
        
        try {
            $pDados['CPF'] = preg_replace('/\D/', '', $pDados['CPF']);

            $sql = "SELECT * FROM USERS WHERE CPF = :CPF AND PASSWORD = :PASSWORD";
            $stmt = $this->pdo->prepare($sql);
            
            $dados = [
                ':CPF' => $pDados['CPF'],
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