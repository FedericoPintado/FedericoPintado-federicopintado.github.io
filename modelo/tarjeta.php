<?php

require_once 'bd.php';

class Tarjeta {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Insertar una nueva tarjeta
    public function insertarTarjeta($titulo, $enlace, $imagen, $descripcion, $categoria, $fecha, $autor) {
        $sql = "INSERT INTO tarjeta (titulo, enlace, imagen, descripcion, categoria, fecha, autor) VALUES (:titulo, :enlace, :imagen, :descripcion, :categoria, :fecha, :autor)";
        
        $stmt = $this->db->connect()->prepare($sql);
        
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':enlace', $enlace);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB); // BLOB
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':autor', $autor);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Obtener todas las tarjetas
    public function obtenerTarjetas() {
        $sql = "SELECT * FROM tarjeta";
        
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        
        // Obtener todas las tarjetas
        $tarjetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Verificar si se obtuvieron resultados
        if ($tarjetas) {
            // Recorrer cada tarjeta y modificar la imagen y la descripcion si existen
            foreach ($tarjetas as &$tarjeta) {
                // Modificar la imagen si existe
                if (isset($tarjeta['imagen']) && $tarjeta['imagen']) {
                    $tarjeta['imagen'] = base64_encode($tarjeta['imagen']);
                }
                
                // Si 'descripcion' es null, asignamos un valor vacío
                if (isset($tarjeta['descripcion']) && $tarjeta['descripcion'] === null) {
                    $tarjeta['descripcion'] = " ";  // Asignamos un espacio vacío
                }
            }
        } else {
            // Si no se encontraron tarjetas, puedes devolver un array vacío
            return [];  // Asegura que se retorne un array vacío en caso de no encontrar resultados
        }
    
        // Filtrar valores nulos y vacíos
        $tarjetas = array_filter($tarjetas, function($value) {
            return !empty($value);  // Elimina los valores vacíos y null
        });
    
        return $tarjetas;  // Retornar el array de tarjetas limpio
    }
    
    
    

    // Obtener una tarjeta por ID
    public function obtenerTarjetaPorId($id) {
        $sql = "SELECT * FROM tarjeta WHERE id = :id";
        
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}




?>
