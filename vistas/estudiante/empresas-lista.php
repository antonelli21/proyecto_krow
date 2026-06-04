<?php
/**
 * empresas-lista.php
 * Lista de empresas con filtros de modalidad y jornada
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$modalidad = $_GET['modalidad'] ?? '';
$jornada = $_GET['jornada'] ?? '';

try {
    // Construir consulta con filtros
    $query = "SELECT * FROM usuarios WHERE tipo = 'empresa' AND aprobada = true";
    $params = [];
    
    if (!empty($modalidad)) {
        $query .= " AND id IN (SELECT empresa_id FROM ofertas WHERE modalidad = ?)";
        $params[] = $modalidad;
    }
    
    if (!empty($jornada)) {
        $query .= " AND id IN (SELECT empresa_id FROM ofertas WHERE jornada = ?)";
        $params[] = $jornada;
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $empresas = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <div class="row">
            <?php include '../../includes/sidebar-filtros.php'; ?>
            
            <main class="col-md-9">
                <h1>Empresas</h1>
                
                <div class="empresas-grid">
                    <?php foreach ($empresas as $empresa): ?>
                        <div class="empresa-card">
                            <h3><?php echo htmlspecialchars($empresa['nombre_empresa']); ?></h3>
                            <p><?php echo htmlspecialchars($empresa['email']); ?></p>
                            <div class="reputacion">
                                ⭐ <?php echo $empresa['reputacion'] ?? 0; ?>
                            </div>
                            <a href="oferta-detalle.php" class="btn btn-primary">Ver Ofertas</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
