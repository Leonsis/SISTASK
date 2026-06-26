<?php
require_once __DIR__ . '/../Core/Controller.php';

class EmpresaController extends Controller{

    private $pdo;

    public function __construct() {
        // global $pdo; Não está funcionando
        require_once __DIR__ . '/../conexao/Conexao.php';
        $this->pdo = $pdo;
    }

    public function viewCadastroEmp()
    {
        $this->view('cadastrarEmpresa');
    }

    /* lógica de cadastro da empresa */
    public function cadastrarEmpresaAction() {
        $pDados = isset($_POST) ? $_POST : [];
       
        try {

            $pDados['CNPJ'] = preg_replace('/[^a-zA-Z0-9]/', '', $pDados['CNPJ']);
            
            // Verifica se já foi registrado uma conta com o CPF/CNPJ
            $sql = "SELECT * FROM EMPRESA WHERE CNPJ = :CNPJ";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':CNPJ' => $pDados['CNPJ']
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                echo json_encode(['status' => 'erro', 'mensagem' => 'CNPJ já cadastrado']);
                exit;
            }

            $sql = "INSERT INTO EMPRESA(CNPJ, RAZAO_SOCIAL, NOME_FANTASIA, DATA_ABERTURA)
                VALUES ( :CNPJ, :RAZAO_SOCIAL, :NOME_FANTASIA, :DATA_ABERTURA)";

            $stmt = $this->pdo->prepare($sql);

            $resultado = $stmt->execute([
                ':CNPJ'          => $pDados['CNPJ'],
                ':RAZAO_SOCIAL'  => $pDados['RAZAO_SOCIAL'],
                ':NOME_FANTASIA' => $pDados['NOME_FANTASIA'],
                ':DATA_ABERTURA' => $pDados['DATA_ABERTURA']
            ]);

            if ($resultado) {
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