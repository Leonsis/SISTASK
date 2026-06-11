<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTASKS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/main.css">    
    <script src="https://cloudflare.com"></script>
    <script src="https://cloudflare.com"></script>
    <script src="public/jQuery.js"></script>
    <script src="public/jquery.mask.min.js"></script>
    <script src="public/main.js"></script>
</head>
    <body>

        <div class="scene">
            <div class="card-container">
                <h1>SISTASKS</h1>

                <div class="card-face card-front">
                    <h2>Sign In</h2>
                    <p class="desc">Entre e adminstre sua demandas</p>
                    
                    <form action="../app/controllers/loginController.php" method="POST">
                        <input type="hidden" id="TIPO_FORM" name="TIPO_FORM" value="0">
                        <div class="input-box">
                            <label>CPF/CNPJ</label>
                            <input id="CPF_CNPJ" name="CPF_CNPJ" name="" type="text" placeholder="••••••••" required>
                        </div>
                        <div class="input-box">
                            <label>Senha</label>
                            <input type="password" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn-primary">Sign In</button>
                    </form>

                    <p class="toggle-link">Você não tem conta? <a href="view/criarConta.php">Criar conta</a></p>
                </div>

            </div>
        </div>
    
    </body>
</html>