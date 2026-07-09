<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">

<?php include 'inc/head.php'; ?>

<body>
    
    <?php include 'inc/nav.php'; ?>

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
                        <div class="input-box">
                            <label for="CPF">CPF/CNPJ</label>
                            <input id="CPF" name="CPF" type="text" placeholder="000.000.000-00" required>
                        </div>
                        <div class="input-box">
                            <label for="PASSWORD">Senha</label>
                            <input type="password" name="PASSWORD" id="PASSWORD" placeholder="••••••••" required>
                        </div>
                        <button style="border: 0px;" type="submit" class="curso-badge">Entrar</button>
                    </form>
                    <p class="toggle-link">Não tem conta? <a href="<?= url('/criar-conta') ?>">Criar conta</a></p>                    
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#CPF').mask('000.000.000-00');
        });

        jQuery(document).ready(function($) {
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();

                let dadosFormulario = $(this).serialize();

                $.ajax({
                    url: '<?= url('/autenticar-Action') ?>',
                    type: 'POST',
                    data: dadosFormulario,
                    dataType: 'json',
                    success: function(resposta) {
                        if (resposta.status === 'sucesso') {
                            window.location.href = '<?= url('/painel') ?>';
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