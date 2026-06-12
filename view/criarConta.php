
<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTASKS</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../public/main.css">    
        <script src="https://cloudflare.com"></script>
        <script src="../public/jQuery.js"></script>
        <script src="../public/jquery.mask.min.js"></script>
        <script src="../public/main.js"></script>
    </head>
    <body>

        <div class="scene">
            <div class="card-container">
                <h1>SISTASKS</h1>

                <div class="card-face card-front">
                    <h2>Criar conta</h2>
                    <p class="desc">Join our premium fintech ecosystem.</p>
                    
                    <form id="formCreate">    
                        <div class="input-box">
                            <label>Nome</label>
                            <input name="NOME" id="NOME" type="text" placeholder="John Doe" required>
                        </div>
                        <div class="input-box">
                            <label>você é </label>
                            <select name="PESSOA_FISICA_JURIDICA" id="PESSOA_FISICA_JURIDICA">
                                <option value="0" style="">Pessoa física</option>
                                <option value="1">Pessoa juridica</option>                            
                            </select>
                        </div>
                        <div class="input-box">
                            <label>CPF/CNPJ</label>
                            <input id="CPF_CNPJ" name="CPF_CNPJ" type="text" required>
                        </div>
                        <div class="input-box">
                            <label>Password</label>
                            <input type="password" name="PASSWORD" id="PASSWORD" placeholder="••••••••" required>
                        </div>
                        <div class="input-box">
                            <label>Telefone</label>
                            <input type="text" id="TELEFONE" name="TELEFONE" placeholder="(61) 9999-9999" required>
                        </div>
                        <div class="input-box">
                            <label>Email</label>
                            <input type="text" id="EMAIL" name="EMAIL" placeholder="SISTASK@SISTASK.com" required>
                        </div>
                        <input type="hidden" id="TIPO_FORM" name="TIPO_FORM" value="1">
                        <button type="submit" class="btn-primary">Register Now</button>
                    </form>

                    <p class="toggle-link">Você já tem conta? <a href="../index.php">Log In</a></p>
                </div>

            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
    
                $('#formCreate').on('submit', function(e) {
                    e.preventDefault(); // Impede o recarregamento padrão da página

                    // Transforma todos os inputs do formulário em uma string de dados
                    let dadosFormulario = $(this).serialize();

                    $.ajax({
                        url: '../rotas.php', // Envia os dados para o arquivo que gerencia as ações
                        type: 'POST',
                        data: dadosFormulario,
                        dataType: 'json', // Espera uma resposta estruturada do PHP
                        success: function(resposta) {
                            if(resposta.status === 'sucesso') {
                                alert(resposta.mensagem);
                                window.location.href = '../index.php';
                            } else {
                                alert('Erro: ' + resposta.mensagem);
                            }
                        },
                        error: function(xhr, status, error) {
                            
                            alert('Erro de comunicação com o servidor.');
                        
                            console.log("Status do Erro:", xhr.status);         
                            console.log("Texto do Status:", status);            
                            console.log("Erro Lançado:", error);                
                            console.log("Resposta do Servidor:", xhr.responseText);
                        }
                    });
                });

            });

        </script>
    </body>
</html>