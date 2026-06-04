<?php
/**
 * perfil-estudiante.php
 * Perfil del estudiante con su información y reputación
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'estudiante') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener datos del estudiante
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $estudiante = $stmt->fetch();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <div class="row">
            <?php include '../../includes/sidebar-filtros.php'; ?>
            
            <main class="col-md-9">
                <div class="perfil-estudiante">
                    <h1>Mi Perfil</h1>
                    
                    <div class="perfil-info">
                        <img src="../../public/img/default-avatar.png" alt="Avatar" class="avatar">
                        <div class="datos">
                            <h2><?php echo htmlspecialchars($estudiante['nombre'] ?? 'Estudiante'); ?></h2>
                            <p><?php echo htmlspecialchars($estudiante['email']); ?></p>
                        </div>
                        <div class="reputacion">
                            <span class="badge">⭐ <?php echo $estudiante['reputacion'] ?? 0; ?> Reputación</span>
                        </div>
                    </div>
                    
                    <div class="seccion-editar">
                        <h3>Editar Información</h3>
                        <form method="POST">
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="nombre" value="<?php echo htmlspecialchars($estudiante['nombre'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="tel" name="telefono" value="<?php echo htmlspecialchars($estudiante['telefono'] ?? ''); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
