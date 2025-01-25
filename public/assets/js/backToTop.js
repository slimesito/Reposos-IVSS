$(document).ready(function() {
    // Mostrar el botón de "Volver a arriba" cuando la página se desplaza más allá de un cierto punto
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) { // Puedes ajustar el valor según sea necesario
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    // Suavizar el desplazamiento hacia arriba al hacer clic en el botón
    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
});