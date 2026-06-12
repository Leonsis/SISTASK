$(document).ready(function () {

    /* ===============================
       DOM Elements
    =============================== */
    const $hamburger = $('.hamburger');
    const $navMenu = $('.nav-menu');
    const $navLinks = $('.nav-link');

    /* ===============================
       Mobile menu toggle
    =============================== */
    $hamburger.on('click', function () {
        $(this).toggleClass('active');
        $navMenu.toggleClass('active');
    });

    /* ===============================
       Close mobile menu on link click
    =============================== */
    $navLinks.on('click', function () {
        $hamburger.removeClass('active');
        $navMenu.removeClass('active');
    });

    /* ===============================
       Smooth scrolling
    =============================== */
    $navLinks.on('click', function (e) {
        e.preventDefault();

        const targetId = $(this).attr('href');
        const $target = $(targetId);

        if ($target.length) {
            const offsetTop = $target.offset().top - 70;

            $('html, body').animate({
                scrollTop: offsetTop
            }, 600);
        }
    });

    /* ===============================
       Navbar background on scroll
    =============================== */
    $(window).on('scroll', function () {
        const $navbar = $('.navbar');

        if ($(this).scrollTop() > 50) {
            $navbar.css('background-color', 'rgba(19, 19, 31, 0.98)');
        } else {
            $navbar.css('background-color', 'rgba(19, 19, 31, 0.95)');
        }
    });

    /* ===============================
       Active link on scroll
    =============================== */
    $(window).on('scroll', function () {
        let current = '';

        $('section').each(function () {
            const sectionTop = $(this).offset().top;
            if ($(window).scrollTop() >= sectionTop - 200) {
                current = $(this).attr('id');
            }
        });

        $navLinks.removeClass('active');
        $navLinks.each(function () {
            if ($(this).attr('href') === `#${current}`) {
                $(this).addClass('active');
            }
        });
    });

    /* ===============================
       Hover stack items
    =============================== */
    $('.stack-item')
        .on('mouseenter', function () {
            $(this).css('transform', 'translateY(-10px) scale(1.05)');
        })
        .on('mouseleave', function () {
            $(this).css('transform', 'translateY(0) scale(1)');
        });

    /* ===============================
       Back to top button
    =============================== */
    const $backToTop = $('<button/>', {
        class: 'back-to-top',
        html: '<i class="fas fa-arrow-up"></i>'
    }).css({
        position: 'fixed',
        bottom: '30px',
        right: '30px',
        width: '50px',
        height: '50px',
        backgroundColor: '#f5b645',
        color: '#13131f',
        border: 'none',
        borderRadius: '50%',
        cursor: 'pointer',
        fontSize: '1.2rem',
        opacity: 0,
        visibility: 'hidden',
        transition: 'all 0.3s ease',
        zIndex: 1000
    });

    $('body').append($backToTop);

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $backToTop.css({ opacity: 1, visibility: 'visible' });
        } else {
            $backToTop.css({ opacity: 0, visibility: 'hidden' });
        }
    });

    $backToTop.on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 600);
    });

    $backToTop
        .on('mouseenter', function () {
            $(this).css({
                transform: 'scale(1.1)',
                backgroundColor: '#e6a53a'
            });
        })
        .on('mouseleave', function () {
            $(this).css({
                transform: 'scale(1)',
                backgroundColor: '#f5b645'
            });
        });

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

    $('#CPF_CNPJ').blur(function() {
        if ($(this).val().length <= 14) {
            $('#PESSOA_FISICA_JURIDICA').val('0');
        }
        else {
            $('#PESSOA_FISICA_JURIDICA').val('1');
        }
    });
});