<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Helpers/helpers.php';

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

            $sql = "INSERT INTO USERS (NOME, EMPRESA_ID, CPF, PASSWORD, TELEFONE, EMAIL) 
                    VALUES (:NOME, :EMPRESA, :CPF, :PASSWORD, :TELEFONE, :EMAIL)";
            $stmt = $this->pdo->prepare($sql);
            
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

    // Processa a tentativa de login
    public function autenticarAction() {
        $pDados = isset($_POST) ? $_POST : [];
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $cpf = isset($pDados['CPF']) ? trim($pDados['CPF']) : '';
        $senha = isset($pDados['PASSWORD']) ? trim($pDados['PASSWORD']) : '';

        if (empty($cpf) || empty($senha)) {
            $_SESSION['erro_login'] = "Preencha todos os campos.";
            echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao logar.']);
        }

        $sql = "SELECT * FROM USERS WHERE CPF = :CPF LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $pDados['CPF'] = preg_replace('/\D/', '', $pDados['CPF']);
        $dados = [
            ':CPF' => $pDados['CPF'],
        ];

        $stmt->execute($dados);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            
            if (password_verify($senha, $resultado['PASSWORD'])) {
                
                // Sucesso! Grava os dados do usuário logado na Sessão
                $_SESSION['usuario_logado'] = true;
                $_SESSION['usuario_id']     = $resultado['ID'];
                $_SESSION['usuario_nome']   = $resultado['NOME'];

                // Redireciona para a tela principal (Painel)
                echo json_encode(['status' => 'sucesso', 'mensagem' => 'Login realizado con sucesso!']);
            }
        } 
        else {
            // Se chegou aqui, o usuário ou a senha estão incorretos
            $_SESSION['erro_login'] = "Usuário ou senha inválidos.";
            echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao logar.']);
            exit;
        }
        
    }

}