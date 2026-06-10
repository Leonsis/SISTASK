<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/bootstrap-5.3.8/css/bootstrap.min.css">
        <script src="public/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
        <title>SisTasks</title>
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="text-center mb-4">SisTasks</h1>
            <div id="login" class="w-50 mx-auto border p-4 rounded">
                <form action="app/controllers/loginController.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Logar</button>
                </form>
            </div>

            <div id="criarConta" class="w-50 mx-auto border p-4 rounded d-none">
                <h2 class="text-center mb-4">Criar conta</h2>
                <form action="app/controllers/loginController.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" aria-describedby="nomeHelp">
                    </div>
                    <div class="mb-3">
                        <label for="fisica_juridica" class="form-label">Pessoa Física/Jurídica</label>
                        <select id="fisica_juridica" class="form-select" aria-label="Default select example">
                            <option selected>Escolha uma opção</option>
                            <option value="0">Pessoa Física</option>
                            <option value="1">Pessoa Jurídica</option>                            
                        </select>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" aria-describedby="cnpjHelp">
                    </div>
                    <div class="mb-3 d-none">
                        <label for="NOME_FANTASIA" class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" id="NOME_FANTASIA" aria-describedby="nomeFantasiaHelp">
                    </div>

                    <div class="mb-3 d-none">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" aria-describedby="cpfHelp">
                    </div>

                    <div class="mb-3">
                        <label for="contratado_contratante" class="form-label">Você é</label>
                        <select id="contratado_contratante" class="form-select" aria-label="Default select example">
                            <option selected>Escolha uma opção</option>
                            <option value="0">Contratado</option>
                            <option value="1">Contratante</option>                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" aria-describedby="telefoneHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Cirar conta</button>
                </form>
            </div>
            <div class="d-flex justify-content-center m-3">
                <a href="#" id="temConta" class="btn btn-primary">Tem conta?</a>
                <a href="#" id="jaTenhoConta" class="btn btn-primary d-none">Já tenho conta</a>
            </div>
        </div>
    </body>
    <script>
        document.getElementById('temConta').addEventListener('click', function(event) {
            event.preventDefault();
            const loginDiv = document.getElementById('login');
            const criarContaDiv = document.getElementById('criarConta');
            if (loginDiv.classList.contains('d-none')) {
                loginDiv.classList.remove('d-none');
                criarContaDiv.classList.add('d-none');
            } else {
                loginDiv.classList.add('d-none');
                criarContaDiv.classList.remove('d-none');
            }
        });
        document.getElementById('jaTenhoConta').addEventListener('click', function(event) {
            event.preventDefault();
            const loginDiv = document.getElementById('login');
            const criarContaDiv = document.getElementById('criarConta');
            if (loginDiv.classList.contains('d-none')) {
                loginDiv.classList.remove('d-none');
                criarContaDiv.classList.add('d-none');
            } else {
                loginDiv.classList.add('d-none');
                criarContaDiv.classList.remove('d-none');
            }
        });
        /* Logica para alternar entre CNPJ e CPF de acordo com o tipo de pessoa selecionado */
        document.getElementById('fisica_juridica').addEventListener('change', function(event) {
            const selectedValue = event.target.value;
            const cnpjField = document.getElementById('cnpj');
            const cpfField = document.getElementById('cpf');
            const nomeFantasiaField = document.getElementById('NOME_FANTASIA');
            if (selectedValue === '1') { // Pessoa Jurídica
                cnpjField.parentElement.classList.remove('d-none');
                nomeFantasiaField.parentElement.classList.remove('d-none');
                cpfField.parentElement.classList.add('d-none');                
            } else if (selectedValue === '0') { // Pessoa Física
                cnpjField.parentElement.classList.add('d-none');
                nomeFantasiaField.parentElement.classList.add('d-none');
                cpfField.parentElement.classList.remove('d-none');
                
            } else {
                cnpjField.parentElement.classList.add('d-none');
                nomeFantasiaField.parentElement.classList.add('d-none');
                cpfField.parentElement.classList.add('d-none');
            }
            x
        });
    </script>
</html>