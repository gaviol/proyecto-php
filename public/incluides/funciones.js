
    
        $(document).ready(function() {
            // Cargar personas al cargar la página
            cargarPersonas();

            // Enviar formulario para crear o actualizar persona
            $('#formPersona').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var url = $('#id').val() ? 'update.php' : 'create.php';
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert('Operación exitosa');
                            $('#formPersona')[0].reset();
                            $('#id').val('');
                            cargarPersonas();
                        } else {
                            alert('Error: ' + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error en la solicitud: ' + error);
                    }
                });
            });

            // Botón Cancelar
            $('#btnCancelar').click(function() {
                $('#formPersona')[0].reset();
                $('#id').val('');
            });

            // Función para cargar personas mediante AJAX
            function cargarPersonas() {
                $.ajax({
                    url: 'read.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var html = '';
                        response.forEach(function(persona) {
                            html += '<tr>';
                            html += '<td>' + persona.id + '</td>';
                            html += '<td>' + persona.doce_nombre + '</td>';
                            html += '<td>' + persona.doce_apellido + '</td>';
                            html += '<td>' + persona.per_cumple + '</td>';
                            html += '<td>' + persona.per_mail + '</td>';
                            html += '<td>' + persona.doce_cel + '</td>';
                            html += '<td>';
                            html += '<button class="btn btn-sm btn-primary btnEditar" data-id="' + persona.id + '">Editar</button>';
                            html += '<button class="btn btn-sm btn-danger btnEliminar" data-id="' + persona.id + '">Eliminar</button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('#tablaPersonas').html(html);
                    },
                    error: function(xhr, status, error) {
                        alert('Error en la solicitud: ' + error);
                    }
                });
            }

            // Evento para botones Editar
            $(document).on('click', '.btnEditar', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'read.php?id=' + id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#id').val(response[0].id);
                        $('#doce_nombre').val(response[0].doce_nombre);
                        $('#doce_apellido').val(response[0].doce_apellido);
                        $('#per_cumple').val(response[0].per_cumple);
                        $('#per_mail').val(response[0].per_mail);
                        $('#doce_cel').val(response[0].doce_cel);
                    },
                    error: function(xhr, status, error) {
                        alert('Error en la solicitud: ' + error);
                    }
                });
            });

            // Evento para botones Eliminar
            $(document).on('click', '.btnEliminar', function() {
                var id = $(this).data('id');
                if (confirm('¿Está seguro de eliminar este registro?')) {
                    $.ajax({
                        url: 'delete.php',
                        method: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert('Registro eliminado');
                                cargarPersonas();
                            } else {
                                alert('Error: ' + response.error);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error en la solicitud: ' + error);
                        }
                    });
                }
            });
        });
   
