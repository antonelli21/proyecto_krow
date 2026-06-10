<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();



// Configurar header incluible correctamente
$isIncluded = true;
$basePath = '/guardalo_aca/proyecto_krow';
$publicPath = $basePath . '/public';
$rol = 'estudiante';
$pageTitle = 'Mi Perfil - Krow';

// Modo desarrollo: obligatorio estudiante y datos mock (sin base de datos)
$_SESSION['id_usuario'] = $_SESSION['id_usuario'] ?? 1;
$_SESSION['usuario_rol'] = 'estudiante';

$usuario = [
    'nombre' => 'Juan Pérez',
    'email' => 'juan.perez@example.com',
    'telefono' => '+54 9 11 1234 5678',

];

$estudiante = [
    'legajo' => '173456',
    'dni' => '40123456',
    'edad' => 22,
    'carrera' => 'Ing. en Sistemas de Información',
    'modalidad_deseada' => 'Híbrido / Remoto',
    'puesto_interes' => 'Desarrollo Web, Backend',
    'disponibilidad' => 'Lunes a Viernes, 9hs a 17hs',
    'habilidades' => 'React, TypeScript, Node.js, SQL',
    'idiomas' => 'Español Nativo, Inglés Intermedio',
    'linkedin' => 'https://linkedin.com/in/juanperez',
    'github' => 'https://github.com/juanperez',
    'portafolio' => '',
    'cv_link' => ''
];

$habilidades_array = !empty($estudiante['habilidades']) ? array_map('trim', explode(',', $estudiante['habilidades'])) : [];
$idiomas_array = !empty($estudiante['idiomas']) ? array_map('trim', explode(',', $estudiante['idiomas'])) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Krow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $publicPath; ?>/css/styles.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    
    <div class="container mt-4">
        <div class="card perfil-header-card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center gy-3">
                    <div class="col-auto">
                        <div class="perfil-avatar">
                            <?php echo strtoupper(substr($usuario['nombre'] ?? 'E', 0, 1)); ?>
                        </div>
                    </div>
                    <div class="col">
                        <h1 class="h4 mb-1"><?php echo htmlspecialchars($usuario['nombre'] ?? 'Estudiante'); ?></h1>
                        <p class="mb-1 text-muted"><?php echo htmlspecialchars($estudiante['carrera'] ?? 'Ing. en Sistemas de Información'); ?></p>
                        <p class="mb-0 text-muted">Legajo: <?php echo htmlspecialchars($estudiante['legajo'] ?? '173456'); ?></p>
                    </div>
                    <div class="col-auto">
                        <a href="../configuracion.php" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i> Editar perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><i class="fas fa-user-circle me-2"></i> Datos Personales</div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Nombre completo</div>
                                    <div class="info-value"><?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Edad</div>
                                    <div class="info-value"><?php echo htmlspecialchars($estudiante['edad'] ?? 'No especificada'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">DNI</div>
                                    <div class="info-value"><?php echo htmlspecialchars($estudiante['dni'] ?? 'No especificado'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Correo electrónico</div>
                                    <div class="info-value"><?php echo htmlspecialchars($usuario['email']); ?></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-item">
                                    <div class="info-label">Teléfono</div>
                                    <div class="info-value"><?php echo htmlspecialchars($usuario['telefono'] ?? 'No especificado'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><i class="fas fa-book-open me-2"></i> Datos Académicos</div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Carrera que cursa</div>
                                    <div class="info-value"><?php echo htmlspecialchars($estudiante['carrera'] ?? 'No especificada'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label"># Legajo universitario</div>
                                    <div class="info-value"><?php echo htmlspecialchars($estudiante['legajo'] ?? 'No especificado'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Portafolio (opcional)</div>
                                    <div class="info-value">
                                        <?php if (!empty($estudiante['portafolio'])): ?>
                                            <a href="<?php echo htmlspecialchars($estudiante['portafolio']); ?>" target="_blank" class="red-social-link">
                                                <i class="fas fa-external-link-alt me-1"></i> Ver portafolio
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No cargado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label">Currículum Vitae (link, opcional)</div>
                                    <div class="info-value">
                                        <?php if (!empty($estudiante['cv_link'])): ?>
                                            <a href="<?php echo htmlspecialchars($estudiante['cv_link']); ?>" target="_blank" class="red-social-link">
                                                <i class="fas fa-file-alt me-1"></i> Ver CV
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No cargado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><i class="fas fa-briefcase me-2"></i> Preferencias Laborales</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">Modalidad horaria deseada</div>
                            <div class="info-value"><?php echo htmlspecialchars($estudiante['modalidad_deseada'] ?? 'No especificada'); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Puestos o áreas de interés</div>
                            <div class="info-value"><?php echo htmlspecialchars($estudiante['puesto_interes'] ?? 'No especificado'); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Disponibilidad</div>
                            <div class="info-value"><?php echo htmlspecialchars($estudiante['disponibilidad'] ?? 'No especificada'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><i class="fas fa-code me-2"></i> Habilidades e Idiomas</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-tools me-2"></i> Habilidades y tecnologías</strong>
                            <div class="mt-3">
                                <?php if (!empty($habilidades_array)): ?>
                                    <?php foreach ($habilidades_array as $hab): ?>
                                        <span class="habilidad-badge"><?php echo htmlspecialchars($hab); ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">No especificadas</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <strong><i class="fas fa-language me-2"></i> Idiomas</strong>
                            <div class="mt-3">
                                <?php if (!empty($idiomas_array)): ?>
                                    <?php foreach ($idiomas_array as $idioma): ?>
                                        <span class="idioma-badge"><?php echo htmlspecialchars($idioma); ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">No especificados</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div><i class="fas fa-share-alt me-2"></i> Redes Profesionales</div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">LinkedIn</div>
                            <div class="info-value">
                                <?php if (!empty($estudiante['linkedin'])): ?>
                                    <a href="<?php echo htmlspecialchars($estudiante['linkedin']); ?>" target="_blank" class="red-social-link">
                                        <i class="fab fa-linkedin me-1"></i> <?php echo htmlspecialchars($estudiante['linkedin']); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No agregado</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">GitHub</div>
                            <div class="info-value">
                                <?php if (!empty($estudiante['github'])): ?>
                                    <a href="<?php echo htmlspecialchars($estudiante['github']); ?>" target="_blank" class="red-social-link">
                                        <i class="fab fa-github me-1"></i> <?php echo htmlspecialchars($estudiante['github']); ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No agregado</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
    <script src="../../public/js/main.js"></script>
</body>
</html>