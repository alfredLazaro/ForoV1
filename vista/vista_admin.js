function actContenidoYCont() {
    $.get("../controlador/getContenido.php", function (data) {
        var response = JSON.parse(data);
        var contenidos = response.comentarios;
        var count = response.count;

        // mostrar contador
        $('#count').text("Contenido Total: " + count);

        // mostrar contenido
        $('.contenido-dinamico').empty();
        contenidos.forEach(function (contenido, index) {
            var contenidoHTML = `<div class="col-md-6 offset-md-3"><div class="card bg-success text-white">
                    <div class="card-header d-flex justify-content-between">
                        <span class="custom-header">Contenido ${index + 1} </span>
                        <button class="eleminar-contenido btn btn-danger" data-id="${contenido.id_contenido}">X</button>
                    </div>
                    <div class="card-body bg-light text-dark">
                        <p class="custom-comment" id="comment${index + 1}">
                            ${contenido.texto_contenido}
                        </p>
                        <p class="student-id ml-auto small text-right">Codigo Sis: ${contenido.codigo_sis}</p>
                    </div>
                </div></div>`;
            $('.contenido-dinamico').append(
                contenidoHTML);
        });

        //eliminar contenido y actualizar contador
        $('.eleminar-contenido').on('click', function () {
            var commentId = $(this).data('id');
            var parentCard = $(this).closest('.card');

            $.ajax({
                url: '../controlador/eliminarContenido.php',
                method: 'POST',
                data: {
                    id: commentId
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

setInterval(actContenidoYCont, 10000); // 10000 = 10 segundos //para db

//agregar contenido
$(document).ready(function () {
    $("#agregarFormContenido").submit(function (e) {
        e.preventDefault();
        var texto_contenido = $("#texto_contenido").val();

        $.ajax({
            type: "POST",
            url: "../controlador/agregarContenido.php",
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