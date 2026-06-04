<?php
/**
 * mensajes-empresa.php
 * Panel de mensajería de la empresa
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener conversaciones de la empresa
    $stmt = $pdo->prepare("
        SELECT DISTINCT m.*, u.nombre, u.email
        FROM mensajes m
        JOIN usuarios u ON m.remitente_id = u.id
        WHERE m.destinatario_id = ?
        ORDER BY m.fecha_mensaje DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $mensajes = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <h1>Mensajes</h1>
            
            <div class="mensajes-container">
                <?php if (empty($mensajes)): ?>
                    <p class="sin-mensajes">No tienes mensajes aún</p>
                <?php else: ?>
                    <div class="conversaciones">
                        <?php foreach ($mensajes as $msg): ?>
                            <div class="conversacion-item">
                                <div class="info">
                                    <h4><?php echo htmlspecialchars($msg['nombre'] ?? 'Estudiante'); ?></h4>
                                    <p class="preview"><?php echo htmlspecialchars(substr($msg['contenido'], 0, 50)) . '...'; ?></p>
                                </div>
                                <div class="fecha">
                                    <?php echo date('d/m/Y H:i', strtotime($msg['fecha_mensaje'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
