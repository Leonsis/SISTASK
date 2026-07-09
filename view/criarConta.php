<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">

<?php include 'inc/head.php'; ?>

<body>
    <?php include 'inc/nav.php'; ?>

    <section class="cursos" style="padding: 140px 0 80px 0;">
        <div class="container">
            <h2 class="section-title">Criar uma conta</h2>
            <div class="cursos-grid">
                <div class="curso-item" style="max-width: 520px; margin: 0 auto;">
                    <div class="curso-header">
                        <h3>Cadastro</h3>
                        <span class="curso-badge">SISTASKS</span>
                    </div>
                    <p>Cadastre-se para acessar o painel de gestão e controle de chamados.</p>
                    <form id="formCreate">
                        <div class="input-box">
                            <label for="NOME">Nome completo</label>
                            <input name="NOME" id="NOME" type="text" placeholder="John Doe" required>
                        </div>
                        <div class="input-box">
                            <label for="EMPRESA">Tipo de pessoa</label>
                            <select name="EMPRESA" id="EMPRESA" required>
                                <?php foreach ($empresas as $empresa): ?>
                                    <option value="<?= $empresa['ID'] ?>">
                                        <?= htmlspecialchars($empresa['NOME_FANTASIA']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="toggle-link" style="margin: 0px; !important">Sua empresa está <a href="<?= url('/cadastro-empresa')?>">cadastrada</a>?</p>
                        </div>
                        <div class="input-box">
                            <label for="CPF">CPF</label>
                            <input id="CPF" name="CPF" type="text" placeholder="000.000.000-00" required>
                        </div>
                        <div class="input-box">
                            <label for="PASSWORD">Senha</label>
                            <input type="password" name="PASSWORD" id="PASSWORD" placeholder="••••••••" required>
                        </div>
                        <div class="input-box">
                            <label for="TELEFONE">Telefone</label>
                            <input type="text" id="TELEFONE" name="TELEFONE" placeholder="(61) 9999-9999" required>
                        </div>
                        <div class="input-box">
                            <label for="EMAIL">Email</label>
                            <input type="email" id="EMAIL" name="EMAIL" placeholder="seu@email.com" required>
                        </div>
                        <button style="border: 0px;" type="submit" class="curso-badge">Criar conta</button>
                    </form>
                    <p class="toggle-link">Já tem conta? <a href="<?= url('/') ?>">Entrar</a></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#CPF').mask('000.000.000-00');
            $('#TELEFONE').mask('(00) 00000-0000');
        });

        jQuery(document).ready(function($) {
            $('#formCreate').on('submit', function(e) {
                e.preventDefault();

                let dadosFormulario = $(this).serialize();

                $.ajax({
                    url: '<?= url('/criar-login-action') ?>',
                    type: 'POST',
                    data: dadosFormulario,
                    dataType: 'json',
                    success: function(resposta) {
                        if (resposta.status === 'sucesso') {
                            alert(resposta.mensagem);
                            window.location.href = '<?= url('/') ?>';
                        } else {
                            alert('Erro: ' + resposta.mensagem);
                            window.location.href = '<?= url('/') ?>';
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