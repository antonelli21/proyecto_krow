<?php
/**
 * home-empresa.php
 * Home/Dashboard para empresas
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener datos de la empresa
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $empresa = $stmt->fetch();
    
    // Obtener estadísticas de ofertas
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total_ofertas FROM ofertas WHERE empresa_id = ?
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $stats_ofertas = $stmt->fetch();
    
    // Obtener postulaciones recibidas
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as total_postulaciones FROM postulaciones p
        JOIN ofertas o ON p.oferta_id = o.id
        WHERE o.empresa_id = ?
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $stats_postulaciones = $stmt->fetch();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Empresa - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <h1>Bienvenido, <?php echo htmlspecialchars($empresa['nombre_empresa']); ?></h1>
            
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Ofertas Publicadas</h3>
                    <p class="numero"><?php echo $stats_ofertas['total_ofertas']; ?></p>
                    <a href="base-empresa.php" class="link">Ver todas</a>
                </div>
                
                <div class="stat-card">
                    <h3>Postulaciones Recibidas</h3>
                    <p class="numero"><?php echo $stats_postulaciones['total_postulaciones']; ?></p>
                    <a href="postulantes-empresa.php" class="link">Ver postulantes</a>
                </div>
                
                <div class="stat-card">
                    <h3>Mensajes</h3>
                    <p class="numero">0</p>
                    <a href="mensajes-empresa.php" class="link">Ir a mensajes</a>
                </div>
            </div>
            
            <div class="acciones-rapidas">
                <h2>Acciones Rápidas</h2>
                <a href="base-empresa.php" class="btn btn-primary">Crear Nueva Oferta</a>
                <a href="../../vistas/configuracion.php" class="btn btn-secondary">Configurar Perfil</a>
            </div>
        </main>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
