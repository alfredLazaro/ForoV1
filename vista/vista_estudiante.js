//actualiza el contenido y el contador
function actContenidoYCont() {
    $.get("../controlador/getContenido.php", function (data) {
        var response = JSON.parse(data);
        var contenidos = response.comentarios;
        var count = response.count;

        // mostrar contador
        $('#count').text("Contenido Total: " + count);

        // mostrar contenido con botones modificar-contenido y eleminar-contenido
        $('.contenido-dinamico').empty();
        contenidos.forEach(function (contenido, index) {
            //console.log(contenido);
            var contenidoHTML = `<div class="col-md-6 offset-md-3"><div class="card bg-success text-white">
                <div class="card-header d-flex justify-content-between">
                    <span class="custom-header">${contenido.isAdmin ? 'Anuncio' : 'Contenido'} ${index + 1}</span>
                    <div class="button-container">
                    </div>
                </div>
                <div class="card-body bg-light text-dark">
                    <p class="custom-comment" id="comment${index + 1}">
                        ${contenido.texto_contenido}
                    </p>
                    <p class="student-id ml-auto small text-right">${contenido.isAdmin ? 'Admin' : 'Codigo Sis: ' + contenido.codigo_sis}</p>
                </div>
                </div></div>`;

            $('.contenido-dinamico').append(
                contenidoHTML);
        });

        //eliminar contenido y actualizar contador
        $('.eleminar-contenido').on('click', function () {
            var commentId = $(this).data('id');
            var parentCard = $(this).closest('.card');
            // var codigo_sis = '<?php echo $_SESSION["codigo_sis"]; ?>';

            $.ajax({
                // url: '../controlador/eliminarContenido.php',
                url: '../controlador/eliminarContenido.php',
                method: 'POST',
                data: {
                    id: commentId
                    // codigo_sis: codigo_sis
                },
                success: function (response) {
                    var parsedResponse = JSON.parse(response);
                    if (parsedResponse.success) {
                        var count = parseInt($('#count').text().replace(
                            "Contenido Total: ", "")) - 1;
                        $('#count').text("Contenido Total: " + count);
                        parentCard.remove();
                    } else {
                        alert('Error en la eliminacion de contenido.');
                    }
                }
            });
        });
    });
}

actContenidoYCont();

//se puede mofificar para actualizar cada n segundos
setInterval(actContenidoYCont, 7000); // 10000 = 10 segundos //para db

//agregar contenido
$(document).ready(function () {
    $("#agregarFormContenido").submit(function (e) {
        e.preventDefault();
        var texto_contenido = $("#texto_contenido").val();

        $.ajax({
            type: "POST",
            // url: "../controlador/agregarContenido.php",
            url: "../controlador/agregarContenidoEstudiante.php",
            data: {
                texto_contenido: texto_contenido
            },
            success: function (data) {
                actContenidoYCont();
                $('#texto_contenido').val("");
                $('#agregarNuevoModal').modal('hide');
            },
            error: function () {
                alert('Fracaso agregar contenido nuevo.');
            }
        });
    });
});

// //modificar contenido
// $(document).ready(function () {
//     //$('.modificar-contenido').on('click', function () {
//     $('.contenido-dinamico').on('click', '.modificar-contenido', function () {
//         var idContenid = $(this).data('id');
//         var texto = $(this).closest('.card').find('.custom-comment').text();

//         // $('#texto_modificar').val(texto);
//         $('#modificar_texto').val(texto.trim());
//         $('#modificarModal').modal('show');

//         $('#modificarFormContenido').off('submit').on('submit', function (e) {
//             e.preventDefault();
//             var nuevoTexto = $('#modificar_texto').val();

//             $.ajax({
//                 type: "POST",
//                 url: "../controlador/modificarContenido.php",
//                 data: {
//                     id: idContenid,
//                     texto_contenido: nuevoTexto
//                 },
//                 success: function (data) {
//                     actContenidoYCont();
//                     $('#modificar_texto').val("");
//                     $('#modificarModal').modal('hide');
//                 },
//                 error: function () {
//                     alert('Fracaso al modificar contenido.');
//                 }
//             });
//         });
//     });
// });
