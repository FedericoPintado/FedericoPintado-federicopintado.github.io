$(document).ready(function() {
    // Función para cargar las tarjetas con jQuery
    function cargarTarjetas() {
      $.ajax({
        url: '../controlador/get_tarjetas.php',  // URL del archivo PHP que devuelve las tarjetas
        type: 'GET',
        
        success: function(response) {
            console.log("Respuesta del servidor:", response);
    
            // Limpiamos el contenedor antes de agregar nuevas tarjetas
            $('#tarjetas-container').empty();
    
            // Verifica si la respuesta tiene el formato adecuado
            if (Array.isArray(response)) {
                // Iteramos sobre las tarjetas y generamos el HTML para cada una
                $.each(response, function(index, tarjeta) {
                    // Validamos los valores de los campos para evitar valores vacíos
                    var titulo = tarjeta.titulo || "Título no disponible";
                    var descripcion = tarjeta.descripcion || "Descripción no disponible";
                    var autor = tarjeta.autor || "Autor no disponible";
                    var fecha = tarjeta.fecha || "Fecha no disponible";
                    var imagen = tarjeta.imagen;  // Imagen por defecto si no existe
                    var enlace = tarjeta.enlace;
                    // Generamos el HTML de la tarjeta
                    var tarjetaHTML = `
                      <a href="${enlace}" style="color: black; text-decoration: none;">
                        <div class="cardsJuegos">
                          <img class="juegoimg" src="data:image/jpeg;base64,${imagen}" alt="Imagen del juego">
                          <div style="display: block; width: 100%;">
                            <div class="contenedorContenido">
                              <h3 class="titulo">${titulo}</h3>
                              <p class="descripcionGame descripcion">${descripcion}</p>
                            </div>
                            <div class="fechaXautor">
                              <p class="fecha">Fecha: ${fecha}</p>
                              <p class="autor">Autor: ${autor}</p>
                            </div>
                          </div>
                        </div>
                      </a>
                    `;
                    
                    // Añadimos el HTML de la tarjeta al contenedor
                    $('.containerGame').append(tarjetaHTML);
                });
            } else {
                console.error("Error: La respuesta no es un array de tarjetas.");
            }
        },
        error: function(xhr, status, error) {
          console.error("Error al cargar las tarjetas: " + error);
        }
      });
    }
    

    // Llamamos a la función para cargar las tarjetas cuando la página esté lista
    cargarTarjetas();
  });