$(document).ready(function() {

    // Função que ajusta o campo CPF/CNPJ
    function ajustarMaskCPFCNPJ() {
        if ($('#PESSOA_FISICA_JURIDICA').val() === '0') {
            $('#CPF_CNPJ').attr('placeholder', '000.000.000-00');
            //$('#CPF_CNPJ').mask('000.000.000-00');
        } else if ($('#PESSOA_FISICA_JURIDICA').val() === '1') {
            $('#CPF_CNPJ').attr('placeholder', '00.000.000/0001-00');
            //$('#CPF_CNPJ').mask('00.000.000/0000-00');
        } else {
            // Caso esteja na opção "Selecione..."
            $('#CPF_CNPJ').attr('placeholder', 'Selecione o tipo de pessoa primeiro');
            $('#CPF_CNPJ').attr('maxlength', '0'); 
        }
    }
    ajustarMaskCPFCNPJ();

    $('#PESSOA_FISICA_JURIDICA').change(function() {
        $('#CPF_CNPJ').val(''); 
        ajustarMaskCPFCNPJ();
    });
});