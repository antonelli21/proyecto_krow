<?php
/**
 * postulaciones-lista.php
 * Lista de postulaciones del estudiante a ofertas
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'estudiante') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener postulaciones del estudiante
    $stmt = $pdo->prepare("
        SELECT p.*, o.titulo, o.descripcion, u.nombre_empresa
        FROM postulaciones p
        JOIN ofertas o ON p.oferta_id = o.id
        JOIN usuarios u ON o.empresa_id = u.id
        WHERE p.estudiante_id = ?
        ORDER BY p.fecha_postulacion DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $postulaciones = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Postulaciones - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <div class="row">
            <?php include '../../includes/sidebar-filtros.php'; ?>
            
            <main class="col-md-9">
                <h1>Mis Postulaciones</h1>
                
                <div class="postulaciones-lista">
                    <?php if (empty($postulaciones)): ?>
                        <p class="sin-postulaciones">No tienes postulaciones aún</p>
                    <?php else: ?>
                        <?php foreach ($postulaciones as $post): ?>
                            <div class="postulacion-item">
                                <div class="info">
                                    <h3><?php echo htmlspecialchars($post['titulo']); ?></h3>
                                    <p class="empresa"><?php echo htmlspecialchars($post['nombre_empresa']); ?></p>
                                    <p class="estado">Estado: <span class="badge"><?php echo htmlspecialchars($post['estado']); ?></span></p>
                                </div>
                                <div class="fecha">
                                    <?php echo date('d/m/Y', strtotime($post['fecha_postulacion'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
