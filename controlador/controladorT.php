<?php

require_once '../modelo/tarjeta.php';

class TarjetaController {
    
    private $tarjetaModel;

    public function __construct() {
        $this->tarjetaModel = new Tarjeta();
    }

    // Mostrar el formulario de carga de tarjeta
    public function mostrarFormulario() {
        require_once 'app/views/tarjeta_form.php';
    }

    // Procesar el formulario de tarjeta
    public function cargarTarjeta() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
            $titulo = $_POST['titulo'];
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer imagen
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $fecha = $_POST['fecha'];

            if ($this->tarjetaModel->insertarTarjeta($titulo, $imagen, $descripcion, $categoria, $fecha)) {
                echo "Tarjeta cargada correctamente.";
            } else {
                echo "Error al cargar la tarjeta.";
            }
        } else {
            echo "No se ha enviado el formulario correctamente.";
        }
    }

    // Listar las tarjetas
    public function listarTarjetas() {
        $tarjetas = $this->tarjetaModel->obtenerTarjetas();
        require_once 'app/views/tarjeta_list.php';
    }

    // Ver una tarjeta específica
    public function verTarjeta($id) {
        $tarjeta = $this->tarjetaModel->obtenerTarjetaPorId($id);
        require_once 'app/views/tarjeta_detail.php';
    }
}


if (isset($_POST["agregar"])) {
    $tarjeta= new Tarjeta();
    $titulo = $_POST['titulo'];
    $enlace =$_POST['enlace'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer imagen
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $fecha = $_POST['fecha'];
    $autor = $_POST['autor'];

    if ($tarjeta->insertarTarjeta($titulo, $enlace,  $imagen, $descripcion, $categoria, $fecha, $autor)) {
        echo "Tarjeta cargada correctamente.";
    } else {
        echo "Error al cargar la tarjeta.";
    }
} else {
    echo"biena";
}
       



?>
