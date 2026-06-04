<?php
/**
 * oferta-detalle.php
 * Vista detallada de una oferta específica
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$oferta_id = $_GET['id'] ?? null;

if (!$oferta_id) {
    header('Location: empresas-lista.php');
    exit;
}

try {
    // Obtener detalles de la oferta
    $stmt = $pdo->prepare("
        SELECT o.*, u.nombre_empresa, u.email, u.telefono
        FROM ofertas o
        JOIN usuarios u ON o.empresa_id = u.id
        WHERE o.id = ? AND o.estado = 'activa'
    ");
    $stmt->execute([$oferta_id]);
    $oferta = $stmt->fetch();
    
    if (!$oferta) {
        header('Location: empresas-lista.php');
        exit;
    }
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Oferta - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <div class="row">
            <?php include '../../includes/sidebar-filtros.php'; ?>
            
            <main class="col-md-9">
                <div class="oferta-detalle">
                    <h1><?php echo htmlspecialchars($oferta['titulo']); ?></h1>
                    
                    <div class="info-empresa">
                        <h3><?php echo htmlspecialchars($oferta['nombre_empresa']); ?></h3>
                        <p><?php echo htmlspecialchars($oferta['email']); ?></p>
                    </div>
                    
                    <div class="oferta-datos">
                        <span class="badge"><?php echo htmlspecialchars($oferta['modalidad']); ?></span>
                        <span class="badge"><?php echo htmlspecialchars($oferta['jornada']); ?></span>
                        <?php if (!empty($oferta['salario'])): ?>
                            <span class="badge">$<?php echo htmlspecialchars($oferta['salario']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="descripcion">
                        <h3>Descripción</h3>
                        <p><?php echo nl2br(htmlspecialchars($oferta['descripcion'])); ?></p>
                    </div>
                    
                    <?php if (!empty($oferta['experiencia'])): ?>
                        <div class="experiencia">
                            <h3>Experiencia Requerida</h3>
                            <p><?php echo nl2br(htmlspecialchars($oferta['experiencia'])); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="acciones">
                        <button class="btn btn-primary">Postularme</button>
                        <button class="btn btn-secondary">Guardar Oferta</button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
