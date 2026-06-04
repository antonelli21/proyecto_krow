<?php
/**
 * crear_oferta.php
 * Inserta un nuevo puesto desde base-empresa
 */

session_start();
require_once '../config/conexion.php';

// Verificar que el usuario sea una empresa
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    http_response_code(403);
    die('Acceso denegado');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $modalidad = trim($_POST['modalidad'] ?? ''); // presencial, remoto, hibrido
    $jornada = trim($_POST['jornada'] ?? ''); // completa, media, pasantia
    $experiencia = trim($_POST['experiencia'] ?? '');
    $salario = trim($_POST['salario'] ?? '');
    
    if (empty($titulo) || empty($descripcion) || empty($modalidad) || empty($jornada)) {
        echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO ofertas (empresa_id, titulo, descripcion, modalidad, jornada, experiencia, salario, fecha_creacion, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'activa')
        ");
        
        $stmt->execute([
            $_SESSION['usuario_id'],
            $titulo,
            $descripcion,
            $modalidad,
            $jornada,
            $experiencia,
            $salario
        ]);
        
        echo json_encode(['success' => true, 'message' => 'Oferta creada exitosamente']);
        exit;
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos']);
        exit;
    }
}
?>
