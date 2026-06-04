<?php
/**
 * configuracion.php
 * Página de configuración de perfil
 */

session_start();
require_once '../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id'])) {
    header('Location: auth/login.php');
    exit;
}

try {
    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Krow</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <main class="configuracion-container">
            <h1>Configuración</h1>
            
            <div class="tabs">
                <button class="tab-button active" onclick="mostrarTab('perfil')">Perfil</button>
                <button class="tab-button" onclick="mostrarTab('privacidad')">Privacidad</button>
                <button class="tab-button" onclick="mostrarTab('notificaciones')">Notificaciones</button>
                <button class="tab-button" onclick="mostrarTab('cuenta')">Cuenta</button>
            </div>
            
            <!-- Tab: Perfil -->
            <div id="tab-perfil" class="tab-content active">
                <h2>Información de Perfil</h2>
                <form method="POST">
                    <?php if ($_SESSION['usuario_tipo'] === 'empresa'): ?>
                        <div class="form-group">
                            <label>Nombre de Empresa</label>
                            <input type="text" name="nombre_empresa" value="<?php echo htmlspecialchars($usuario['nombre_empresa']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>CUIT</label>
                            <input type="text" name="cuit" value="<?php echo htmlspecialchars($usuario['cuit']); ?>" required>
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?>">
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono'] ?? ''); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
            
            <!-- Tab: Privacidad -->
            <div id="tab-privacidad" class="tab-content">
                <h2>Privacidad</h2>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="perfil_publico"> Perfil Público
                    </label>
                    <p>Permite que otros usuarios vean tu perfil</p>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="mostrar_email"> Mostrar Email
                    </label>
                    <p>Permite que otros vean tu email</p>
                </div>
            </div>
            
            <!-- Tab: Notificaciones -->
            <div id="tab-notificaciones" class="tab-content">
                <h2>Notificaciones</h2>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="notif_nuevas_ofertas" checked> Nuevas Ofertas
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="notif_mensajes" checked> Mensajes
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="notif_postulaciones" checked> Postulaciones
                    </label>
                </div>
            </div>
            
            <!-- Tab: Cuenta -->
            <div id="tab-cuenta" class="tab-content">
                <h2>Administración de Cuenta</h2>
                <div class="cuenta-options">
                    <div class="option">
                        <h3>Cambiar Contraseña</h3>
                        <button class="btn btn-secondary" onclick="mostrarFormularioPassword()">Cambiar</button>
                    </div>
                    <div class="option">
                        <h3>Descargar Datos</h3>
                        <button class="btn btn-secondary">Descargar</button>
                    </div>
                    <div class="option">
                        <h3>Eliminar Cuenta</h3>
                        <button class="btn btn-danger">Eliminar Permanentemente</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function mostrarTab(nombre) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            document.getElementById('tab-' + nombre).classList.add('active');
            event.target.classList.add('active');
        }
        
        function mostrarFormularioPassword() {
            alert('Formulario de cambio de contraseña');
        }
    </script>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>
