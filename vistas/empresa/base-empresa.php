<?php
/**
 * base-empresa.php
 * Base de datos de ofertas de la empresa - crear, editar, eliminar
 */

session_start();
require_once '../../config/conexion.php';

// Verificar autenticación
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header('Location: ../auth/login.php');
    exit;
}

try {
    // Obtener ofertas de la empresa
    $stmt = $pdo->prepare("
        SELECT * FROM ofertas 
        WHERE empresa_id = ? 
        ORDER BY fecha_creacion DESC
    ");
    $stmt->execute([$_SESSION['usuario_id']]);
    $ofertas = $stmt->fetchAll();
    
} catch (PDOException $e) {
    die('Error en la base de datos');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ofertas - Krow</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <h1>Mi Base de Ofertas</h1>
            
            <div class="acciones">
                <button class="btn btn-primary" onclick="mostrarFormularioOferta()">+ Nueva Oferta</button>
            </div>
            
            <!-- Formulario Modal para crear/editar oferta -->
            <div id="modal-oferta" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="cerrarModal()">&times;</span>
                    <h2>Nueva Oferta</h2>
                    <form id="form-oferta">
                        <div class="form-group">
                            <label>Título del Puesto</label>
                            <input type="text" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Modalidad</label>
                            <select name="modalidad" required>
                                <option value="presencial">Presencial</option>
                                <option value="remoto">Remoto</option>
                                <option value="hibrido">Híbrido</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jornada</label>
                            <select name="jornada" required>
                                <option value="completa">Jornada Completa</option>
                                <option value="media">Media Jornada</option>
                                <option value="pasantia">Pasantía</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Experiencia Requerida</label>
                            <textarea name="experiencia" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Salario (opcional)</label>
                            <input type="text" name="salario">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Oferta</button>
                    </form>
                </div>
            </div>
            
            <!-- Lista de ofertas -->
            <div class="ofertas-tabla">
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Modalidad</th>
                            <th>Jornada</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ofertas as $oferta): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($oferta['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($oferta['modalidad']); ?></td>
                                <td><?php echo htmlspecialchars($oferta['jornada']); ?></td>
                                <td><span class="badge"><?php echo htmlspecialchars($oferta['estado']); ?></span></td>
                                <td>
                                    <button class="btn-small">Editar</button>
                                    <button class="btn-small btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <script src="../../public/js/main.js"></script>
    <script>
        function mostrarFormularioOferta() {
            document.getElementById('modal-oferta').style.display = 'block';
        }
        
        function cerrarModal() {
            document.getElementById('modal-oferta').style.display = 'none';
        }
        
        document.getElementById('form-oferta').addEventListener('submit', function(e) {
            e.preventDefault();
            // Enviar datos al servidor
            const formData = new FormData(this);
            fetch('../../src/crear_oferta.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Oferta creada exitosamente');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });
    </script>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
