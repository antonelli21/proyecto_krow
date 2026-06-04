<?php
/**
 * gestionar_voto.php
 * Suma los contadores de reputación comunitaria
 */

session_start();
require_once '../config/conexion.php';

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoVoto = $_POST['tipo'] ?? ''; // 'positivo' o 'negativo'
    $objetoId = $_POST['objeto_id'] ?? '';
    $tipoObjeto = $_POST['tipo_objeto'] ?? ''; // 'usuario' o 'empresa'
    
    if (empty($tipoVoto) || empty($objetoId) || empty($tipoObjeto)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Parámetros incompletos']);
        exit;
    }
    
    try {
        // Verificar si ya existe un voto del mismo usuario
        $stmt = $pdo->prepare("
            SELECT id FROM votos 
            WHERE usuario_votante_id = ? AND objeto_id = ? AND tipo_objeto = ?
        ");
        $stmt->execute([$_SESSION['usuario_id'], $objetoId, $tipoObjeto]);
        $votoExistente = $stmt->fetch();
        
        if ($votoExistente) {
            // Actualizar voto existente
            $stmt = $pdo->prepare("UPDATE votos SET tipo = ?, fecha_voto = NOW() WHERE id = ?");
            $stmt->execute([$tipoVoto, $votoExistente['id']]);
        } else {
            // Crear nuevo voto
            $stmt = $pdo->prepare("
                INSERT INTO votos (usuario_votante_id, objeto_id, tipo_objeto, tipo, fecha_voto)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$_SESSION['usuario_id'], $objetoId, $tipoObjeto, $tipoVoto]);
        }
        
        // Actualizar reputación en la tabla de usuarios/empresas
        if ($tipoObjeto === 'usuario') {
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as positivos FROM votos 
                WHERE objeto_id = ? AND tipo_objeto = 'usuario' AND tipo = 'positivo'
            ");
            $stmt->execute([$objetoId]);
            $result = $stmt->fetch();
            
            $stmt = $pdo->prepare("UPDATE usuarios SET reputacion = ? WHERE id = ?");
            $stmt->execute([$result['positivos'], $objetoId]);
        }
        
        echo json_encode(['success' => true, 'message' => 'Voto registrado exitosamente']);
        exit;
        
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos']);
        exit;
    }
}
?>
