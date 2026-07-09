<?php
    // Pega a url no qual o usuario veio.
    $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    $ultimaParte = basename($url);
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro SISTASKS</title>
    <link rel="stylesheet" href="/SisTasks/public/styles.css">
    <script src="/SisTasks/public/jQuery.js"></script>
    <script src="/SisTasks/public/jquery.mask.min.js"></script>
    <script src="/SisTasks/public/script.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <h2>SISTASKS</h2>
            </div>
        </div>
    </nav>

    <section class="cursos" style="padding: 140px 0 80px 0;">
        <div class="container">
            <h2 class="section-title">Cadastrar Empresa</h2>
            <div class="cursos-grid">
                <div class="curso-item" style="max-width: 520px; margin: 0 auto;">
                    <div class="curso-header">
                        <h3>Cadastro da empresa</h3>
                        <span class="curso-badge">SISTASKS</span>
                    </div>
                    <p>Cadastre a sua empresa no sistema e tenha cotrole nas suas demandas</p>
                    <form id="formCadastraEmp" method="POST">             
                        <div class="input-box">
                            <label for="CNPJ">CNPJ</label>
                            <input id="CNPJ" name="CNPJ" type="text" placeholder="00.000.000/0000-00" required>
                        </div>
                        <div class="input-box">
                            <label for="RAZAO_SOCIAL">Razão social</label>
                            <input type="text" name="RAZAO_SOCIAL" id="RAZAO_SOCIAL" required>
                        </div>
                        <div class="input-box">
                            <label for="NOME_FANTASIA">Nome Fantasia</label>
                            <input type="text" name="NOME_FANTASIA" id="NOME_FANTASIA" required>
                        </div>
                        <div class="input-box">
                            <label for="DATA_ABERTURA">Data de Abertura</label>
                            <input type="date" id="DATA_ABERTURA" name="DATA_ABERTURA" required>
                        </div>
                        <button style="border: 0px;" type="submit" class="curso-badge">Cadastrar</button>
                    </form>
                    <p class="toggle-link">Empresa já cadastrada? <a href="<?= (($ultimaParte == 'painel') ? url('/painel') : url('/criar-conta'))?>">Voltar</a></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#CNPJ').mask('AA.AAA.AAA/AAAA-AA');
            
            // API CNPJ
            $('#CNPJ').on('blur', function() {                
                var cnpj = $('#CNPJ').val();
                
                if(!cnpj) {
                    return;
                }

                fetch("https://minhareceita.org/" + cnpj)
                    .then(function(response) {

                        if (response.status !== 200) {
                            alert('CNPJ inválido.');
                            return Promise.reject('CNPJ inválido');
                        }

                        return response.json();
                    })
                    .then(function(data) {
                        console.log(data);
                        $('#RAZAO_SOCIAL').val(data.razao_social);
                        $('#NOME_FANTASIA').val(data.nome_fantasia);
                        $('#DATA_ABERTURA').val(data.data_inicio_atividade);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });
        });

        jQuery(document).ready(function($) {
            $('#formCadastraEmp').on('submit', function(e) {
                e.preventDefault();

                let dadosFormulario = $(this).serialize();

                $.ajax({
                    url: '<?= url('/cadastrar-empresa-action') ?>',
                    type: 'POST',
                    data: dadosFormulario,
                    dataType: 'json',
                    success: function(resposta) {
                        if (resposta.status === 'sucesso') {
                            alert('Empresa Cadastrada');
                            window.location.href = '<?= (($ultimaParte == 'painel') ? url('/painel') : url('/criar-conta')) ?>';
                        } else {
                            alert('Erro: ' + resposta.mensagem);
                            window.location.href = '<?= (($ultimaParte == 'painel') ? url('/painel') : url('/criar-conta')) ?>';
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