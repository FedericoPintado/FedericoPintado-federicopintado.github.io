$(document).ready(function() {
    // Función para manejar el envío del formulario con AJAX
    $('#formularioTarjeta').submit(function(event) {
      // Prevenir que el formulario se envíe de manera tradicional
      event.preventDefault();
  
      // Crear un objeto FormData para enviar los datos del formulario, incluyendo la imagen
      var formData = new FormData();
  
      // Agregar los campos del formulario a FormData
      formData.append('agregar', 'true');
      formData.append('titulo', $('#tituloF').val());
      formData.append('enlace', $('#enlaceF').val());
      formData.append('descripcion', $('#descripcionF').val());
      formData.append('categoria', $('#categoriaF').val());
      formData.append('autor', $('#autorF').val());
      // Agregar la imagen al FormData (si se seleccionó una imagen)
      var imagenF = $('#archivoF')[0].files[0]; // Obtener el archivo de la imagen
      if (imagenF) {
        formData.append('imagen', imagenF);
      }

      var fechaHoy = new Date();
      var fechaFormateada = fechaHoy.toISOString().split('T')[0];  // Formato: 'YYYY-MM-DD'

      // Agregar la fecha al FormData
      formData.append('fecha', fechaFormateada);
  
      // Enviar los datos al servidor usando AJAX
      $.ajax({
        url: '../controlador/controladorT.php',  // Ruta del archivo PHP que procesará los datos
        type: 'POST',  // Usamos POST para enviar los datos
        data: formData,  // Los datos del formulario
        processData: false,  // No procesar los datos (es necesario cuando enviamos archivos)
        contentType: false,  // No establecer el tipo de contenido (también necesario para el archivo)
        success: function(response) {
          console.log("Tarjeta insertada correctamente:", response);
          // Aquí puedes hacer algo con la respuesta del servidor
          // Ejemplo: limpiar el formulario
          $('#formularioTarjeta')[0].reset();  // Resetea el formulario
        },
        error: function(xhr, status, error) {
          console.error("Error al insertar la tarjeta: " + error);
        }
      });
    });
  });
  