$(document).ready(function() {

    // Função que ajusta o campo CPF/CNPJ
    var opcoesCpfCnpj = {
        onKeyPress: function(val, e, field, options) {
            // Remove toda a formatação para contar apenas os números puros
            var numeros = val.replace(/\D/g, '');
            
            // Se digitou mais de 11 números, muda para CNPJ. Senão, mantém CPF.
            // O '##' no final do CPF permite que o usuário digite o 12º número para disparar a troca
            var novaMascara = (numeros.length > 11) ? '00.000.000/0000-00' : '000.000.000-00##';
            
            // 3. Aplica a nova máscara dinamicamente
            $('#CPF_CNPJ').mask(novaMascara, options);
        }
    };

    // Inicializa o campo aceitando até 14 números puros (padrão inicial CPF)
    $('#CPF_CNPJ').mask('000.000.000-00##', opcoesCpfCnpj);
    
    // Mascara do Telefone
    $('#TELEFONE').mask('(00) 00000-0000');
});