<?php
/**
 * postulantes-empresa.php
 * Lista de postulantes que se han aplicado a las ofertas de la empresa
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener postulantes de la empresa
    $stmt = $pdo->prepare("
        SELECT p.*, u.nombre, u.email, o.titulo
        FROM postulaciones p
        JOIN ofertas o ON p.oferta_id = o.id
        JOIN usuarios u ON p.estudiante_id = u.id
        WHERE o.empresa_id = ?
        ORDER BY p.fecha_postulacion DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $postulantes = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulantes - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <h1>Postulantes</h1>
            
            <div class="postulantes-tabla">
                <?php if (empty($postulantes)): ?>
                    <p class="sin-postulantes">No tienes postulantes aún</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Oferta</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($postulantes as $postulante): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($postulante['nombre'] ?? 'Estudiante'); ?></td>
                                    <td><?php echo htmlspecialchars($postulante['email']); ?></td>
                                    <td><?php echo htmlspecialchars($postulante['titulo']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($postulante['fecha_postulacion'])); ?></td>
                                    <td><span class="badge"><?php echo htmlspecialchars($postulante['estado']); ?></span></td>
                                    <td>
                                        <button class="btn-small">Ver Perfil</button>
                                        <button class="btn-small">Enviar Mensaje</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
