<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTASKS Login</title>
    
    <link rel="stylesheet" href="../public/styles.css">
    <script src="../public/jQuery.js"></script>
    <script src="../public/jquery.mask.min.js"></script>
    <script src="../public/script.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>SISTASKS</h2>
            </div>
            <!-- <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Sobre</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Projetos</a></li>
            </ul> -->
        </div>
    </nav>

    <section class="cursos" style="padding: 140px 0 80px 0;">
        <div class="container">
            <h2 class="section-title">Acesse sua conta</h2>
            <div class="cursos-grid">
                <div class="curso-item" style="max-width: 460px; margin: 0 auto;">
                    <div class="curso-header">
                        <h3>Login</h3>
                        <span class="curso-badge">SISTASKS</span>
                    </div>
                    <p>Entrar no painel de gestão de demandas e chamados.</p>
                    <form id="formLogin">
                        <input type="hidden" id="TIPO_FORM" name="TIPO_FORM" value="0">
                        <div class="input-box">
                            <label for="CPF_CNPJ">CPF/CNPJ</label>
                            <input id="CPF_CNPJ" name="CPF_CNPJ" type="text" placeholder="000.000.000-00" required>
                        </div>
                        <div class="input-box">
                            <label for="PASSWORD">Senha</label>
                            <input type="password" name="PASSWORD" id="PASSWORD" placeholder="••••••••" required>
                        </div>
                        <button style="border: 0px;" type="submit" class="curso-badge">Entrar</button>
                    </form>
                    <!-- <div class="curso-footer">
                        <span class="curso-platform">Painel</span>
                        <span class="curso-date">2026</span>
                    </div> -->
                    <p class="toggle-link">Não tem conta? <a href="criarConta.php">Criar conta</a></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        jQuery(document).ready(function($) {
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();

                let dadosFormulario = $(this).serialize();

                $.ajax({
                    url: '../rotas.php',
                    type: 'POST',
                    data: dadosFormulario,
                    dataType: 'json',
                    success: function(resposta) {
                        if (resposta.status === 'sucesso') {
                            window.location.href = '../view/painel.php';
                        } else {
                            alert('Erro: ' + resposta.mensagem);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Erro de comunicação com o servidor.');
                        console.log('Status do Erro:', xhr.status);
                        console.log('Texto do Status:', status);
                        console.log('Erro Lançado:', error);
                        console.log('Resposta do Servidor:', xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>